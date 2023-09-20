@extends('layouts.layout')
@section('content')
<div class="col-md-12">
    <div class="row justify-content-between">
      

      <div class="d-flex align-items-start justify-content-between flex-column p-1 mb-1 col-md-3 box">
        <div class="dashboard_row col-14  bg-white rounded custom-border-light">
          <div class="d-flex align-items-center flex-column box-content">
            <div class="dashboard_title text-subhead p-2">
                Income
            </div>


            <div class="mt-auto p-4">
              <span>
               
                <div class="d-flex flex-column align-items-center">
                   <h1>{{$income}}</h1> 
                 
                </div>
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3 box" >
        <div class="dashboard_row col-14  bg-white rounded custom-border-light">
          <div class="d-flex align-items-center flex-column box-content">
            <div class="dashboard_title text-subhead p-2">Expense</div>

            <div class="mt-auto p-4">
              <span>
                
                <div class="d-flex flex-column align-items-center">
                 
                    <h1>{{$expense}}</h1>
                  
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
              Profit & Loss
            </div>

            <div class="mt-auto p-4">
              <span>
                
                <div class="d-flex flex-column align-items-center">
                        <h1>{{$profitAndLoss}}</h1>
                  
                  </span>
                </div>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="row justify-content-between">
      

      <div class="d-flex align-items-start justify-content-between flex-column p-1 mb-1 col-md-3 box">
        <div class="dashboard_row col-14  bg-white rounded custom-border-light">
          <div class="d-flex align-items-center flex-column box-content">
            <div class="dashboard_title text-subhead p-2">
                Income From Customer
            </div>


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

      <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3 box" >
        <div class="dashboard_row col-14  bg-white rounded custom-border-light">
          <div class="d-flex align-items-center flex-column box-content">
            <div class="dashboard_title text-subhead p-2">Expenses of Staff</div>

            <div class="mt-auto p-4">
              <span>
                
                <div class="d-flex flex-column align-items-center">
                 
                    <h1>{{$staff_expense}}</h1>
                  
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
              Supplier Expense
            </div>

            <div class="mt-auto p-4">
              <span>
                
                <div class="d-flex flex-column align-items-center">
                        <h1>{{$supplier_expense}}</h1>
                  
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
