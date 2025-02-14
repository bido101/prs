@extends('welcome')
@section('content')
    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="w-8 h-8 text-gray-500" style="font-size: 30px;">
                        <i class="fa-regular fa-address-card"></i>
                    </div>
                    <div class="ml-4 text-lg leading-7 font-semibold">
                        @php
                        if(empty(Auth::user()->name)){
                            echo '<a type="button" href="javascript(0)" class="underline text-gray-900 dark:text-gray-900" data-bs-toggle="modal" data-bs-target="#staticBackdrop">'; 
                        }else{
                            echo '<a href="'.route('patient-registration').'" class="underline text-gray-900 dark:text-gray-900">';
                        }
                        @endphp
                            Patient Registration <i class="fa-regular fa-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                        Process of collecting and recording a patient's personal, medical, and insurance details before receiving healthcare services. 
                        This step ensures accurate identification, billing, and medical record management.
                    </div>
                </div>
            </div>

            <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                <div class="flex items-center">
                    <div class="w-8 h-8 text-gray-500" style="font-size: 30px;">
                        <i class="fa-regular fa-address-book"></i>
                    </div>
                    <div class="ml-4 text-lg leading-7 font-semibold">
                    @php
                        if(empty(Auth::user()->name)){
                            echo '<a type="button" href="javascript(0)" class="underline text-gray-900 dark:text-gray-900" data-bs-toggle="modal" data-bs-target="#staticBackdrop">'; 
                        }else{
                            echo '<a href="'.route('patient-information').'" class="underline text-gray-900 dark:text-gray-900">';
                        }
                    @endphp
                        Patient Information <i class="fa-regular fa-circle-right"></i>
                    </a>
                </div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                        Personal, medical, and administrative data collected and maintained by healthcare providers to ensure accurate diagnosis, treatment, and billing.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
