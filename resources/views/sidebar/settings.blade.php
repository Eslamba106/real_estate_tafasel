 @extends('layouts.back-end.app')

 @section('title', translate('settings'))
 
 @push('css_or_js')
     <style>
         body {
             background-color: #f8f9fa;
         }

         .list-container {
             max-width: 800px;
             margin: 10px 10px;
         }

         .list-group-item {
             display: flex;
             justify-content: space-between;
             align-items: center;
             padding: 12px 20px;
             border: none;
             border-bottom: 1px dashed #ddd;
             font-size: 16px;
             color: #007bff;
             text-decoration: none;
         }

         .list-group-item:hover {
             background-color: #f1f1f1;
         }

         .arrow {
             font-size: 14px;
             color: #bbb;
         }
     </style>
 @endpush

 @section('content')
     <div class="container list-container">
         <div class="row">
             <div class="col-md-6">
                 <div class="accordion" id="accordionExample"> 
                    @if (\App\Helpers\Helpers::module_permission_check('theme_settings'))
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" id="headingTwo">
                             <a class="accordion-button"  href="{{ route('theme_settings') }}"   >{{ translate('theme_settings') }}</a>  
                     </div>
                     @endif 
                     @if (\App\Helpers\Helpers::module_permission_check('language'))
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" id="headingTwo">
                             <a class="accordion-button"   href="{{ route('business-settings.language.index') }}"  >{{ translate('language') }}</a>  
                         </h2>  
                     </div>
                     @endif   
                 </div>
             </div> 
         </div>
     </div>
 @endsection

 @push('script') 
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 @endpush
 