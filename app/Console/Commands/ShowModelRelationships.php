<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use ReflectionClass;
use ReflectionMethod;
use Illuminate\Database\Eloquent\Relations\Relation;

class ShowModelRelationships extends Command
{
    protected $signature = 'model:relationships {model?}';
    protected $description = 'Show model relationships for Laravel 8';

    public function handle()
    {
        $modelName = $this->argument('model');
        
        if ($modelName) {
            $this->showModelRelationships($modelName);
        } else {
            $this->showAllModelRelationships();
        }
    }

    private function showAllModelRelationships()
    {
        $modelPath = app_path('Models');
        
        if (!File::exists($modelPath)) {
            $this->error('Models directory not found!');
            return;
        }

        $models = collect(File::allFiles($modelPath))
            ->map(function ($file) {
                return pathinfo($file->getFilename(), PATHINFO_FILENAME);
            })
            ->filter(function ($className) {
                $fullClassName = "App\\Models\\{$className}";
                return class_exists($fullClassName);
            });

        if ($models->isEmpty()) {
            $this->info('No models found!');
            return;
        }

        foreach ($models as $modelName) {
            $this->showModelRelationships($modelName);
            $this->line('');
        }
    }

    private function showModelRelationships($modelName)
    {
        $fullClassName = "App\\Models\\{$modelName}";
        
        if (!class_exists($fullClassName)) {
            $this->error("Model {$fullClassName} not found!");
            return;
        }

        try {
            $model = new $fullClassName;
            $this->info("Model: {$fullClassName}");
            
            $relationships = $this->getModelRelationships($model);
            
            if (empty($relationships)) {
                $this->line('  No relationships found.');
            } else {
                foreach ($relationships as $relationship) {
                    $this->line("  - {$relationship['name']} ({$relationship['type']})");
                }
            }
            
        } catch (\Exception $e) {
            $this->error("Error analyzing {$fullClassName}: " . $e->getMessage());
        }
    }

    private function getModelRelationships($model)
    {
        $relationships = [];
        $reflection = new ReflectionClass($model);
        $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);

        foreach ($methods as $method) {
            // Only check methods defined in the model class (not parent classes)
            if ($method->class === get_class($model)) {
                try {
                    // Skip methods that require parameters
                    if ($method->getNumberOfRequiredParameters() > 0) {
                        continue;
                    }

                    $return = $method->invoke($model);
                    
                    if ($return instanceof Relation) {
                        $relationships[] = [
                            'name' => $method->getName(),
                            'type' => class_basename(get_class($return))
                        ];
                    }
                } catch (\Exception $e) {
                    // Skip methods that throw exceptions
                    continue;
                }
            }
        }

        return $relationships;
    }
}