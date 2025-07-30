@extends('front_office.landing_page')

@section('content')
    <section class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card">
            <div class="card-body d-flex justify-content-center align-items-center bg-light">
            <div class="col-lg-6 ">
                <form action="{{ route('login') }}" method="post" data-aos="fade-up" data-aos-delay="200">
                    @csrf
                    <div class="row gy-4 d-flex justify-content-center align-items-center">
                        <div class="col-12 text-center">
                            <h4 class="mb-4">{{ translate('welcome_back') }}</h4>
                            <p>{{ translate('please_login_to_continue') }}</p>
                        </div>
                        <div class="col-md-12">

                            <label for="username">{{ translate('username') }}</label>
                            <input type="text" name="username" class="form-control"
                                placeholder="{{ translate('enter_your_username') }}" required value="{{ old('username') }}">
                        </div>

                        <div class="col-md-12">
                            <label for="username">{{ translate('password') }}</label>

                            <input type="password" class="form-control" name="password"
                                placeholder="{{ translate('enter_your_password') }}" required value="{{ old('password') }}">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12 text-center">

                            <button type="submit" class="btn btn-primary">{{ translate('login') }}</button>
                        </div>

                    </div>
                </form>
            </div><!-- End Contact Form -->
        </div>
        </div>
    </section>
@endsection
