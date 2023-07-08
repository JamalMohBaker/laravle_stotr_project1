<x-shop-layout title="Update profile">
   <!-- Start Contact Area -->
   <section id="contact-us" class="contact-us section">
    <div class="container">
        <div class="contact-head">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Update Your profile </h2>

                    </div>
                </div>
            </div>
            <div class="contact-info">
                <div class="row">

                    <div class="col-12">
                        <div class="contact-form-head">
                            <div class="form-main">
                                <form class="form" method="post" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('patch')
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <input name="first_name" value="{{ old('first_name', $user->profile->first_name) }}" type="text" placeholder="First Name"
                                                    required="required">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <input name="last_name" type="text" placeholder="Last Name"
                                                value="{{ old('last_name', $user->profile->last_name) }}"  required="required">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <input name="email" type="email" placeholder="Your Email"
                                                value="{{ old('email', $user->email) }}"   required="required">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <input name="birthday" type="date" placeholder="BirthDay"
                                                value="{{ old('birthday', $user->profile->birthday) }}"
                                                    required="required">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group button">
                                                <button type="submit" class="btn ">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Contact Area -->
</x-shop-layout>
