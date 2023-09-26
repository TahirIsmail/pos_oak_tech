@extends('layouts.layout')
@section('content')
<div class="col-md-12">
    <div class="row justify-content-between">
      

      <div class="d-flex align-items-start justify-content-between flex-column p-1 mb-1 col-md-3 box">
        <div class="dashboard_row col-14  bg-white rounded custom-border-light">
          <div class="d-flex align-items-center flex-column box-content">
            <div class="dashboard_title text-subhead p-2">
                Total Income
            </div>


            <div class="mt-auto p-4">
              <span>
               
                <div class="d-flex flex-column align-items-center">
                   <h1>{{$total_income}}</h1> 
                 
                </div>
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3 box" >
        <div class="dashboard_row col-14  bg-white rounded custom-border-light">
          <div class="d-flex align-items-center flex-column box-content">
            <div class="dashboard_title text-subhead p-2">Customer Income</div>

            <div class="mt-auto p-4">
              <span>
                
                <div class="d-flex flex-column align-items-center">
                 
                    <h1>{{$customer_income}}</h1>
                  
                </div>
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3 box">
        <div class="dashboard_row col-14 bg-white rounded custom-border-light"
          >
          <div class="d-flex align-items-center flex-column box-content">
            <div class="dashboard_title text-subhead p-2">
              Project Income
            </div>

            <div class="mt-auto p-4">
              <span>
                
                <div class="d-flex flex-column align-items-center">
                        <h1>{{$project_income}}</h1>
                  
                  </span>
                </div>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
@endsection
