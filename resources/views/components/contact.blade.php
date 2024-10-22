<div id="contact" class="contact-area bg-light-black pb-5">
    <div class="container">


        <div dir="rtl" class="row mb50">
            <!-- contact address -->

            <div class="col-lg-3 col-md-3 col-sm-12 text-center">
                <div class="contact-address pt-5">
                    <h3>تواصل معنا</h3>
                    <p> المملكة العربية السعودية </p>
                    <p> الرياض – أبراج العليا </p>
                    <p>00966-59-303-1810</p>
                </div>

                <ul class="footer-social d-flex justify-content-center">
                    <li class="mr-2"><a href="https://www.facebook.com/skillsarts1/" rel="nofollow"><i
                                class="fa fa-facebook fa-2x"></i></a></li>
                    <li class="mr-2"><a href="https://instagram.com/skillsarts_agency" rel="nofollow"><i
                                class="fa fa-instagram fa-2x"></i></a></li>
                    <li class="mr-2"><a href="https://twitter.com/skillsarts1/" rel="nofollow"><i
                                class="fa fa-twitter fa-2x"></i></a></li>
                    <li class="mr-2"><a href="https://www.snapchat.com/add/skillsarts/" rel="nofollow"><i
                                class="fa fa-snapchat-ghost fa-2x"></i></a></li>
                    <li class="mr-2"><a href="https://wa.me/966593031810?text=السلام عليكم  سكيلز آرتس"
                            rel="nofollow" target=" _blank"><i class="fa fa-whatsapp fa-2x"></i></a></li>

                </ul>
                <div class="col-lg-3 col-md-3 col-sm-12">

                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3624.871536887798!2d46.682078399999995!3d24.696942399999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f033a566aa935%3A0x67869b55889275dd!2z2KPYqNix2KfYrCDYp9mE2LnZhNmK2KcsIEFsIE9sYXlhLCBSaXlhZGggMTIyMTMsIFNhdWRpIEFyYWJpYQ!5e0!3m2!1sen!2sbd!4v1716622366035!5m2!1sen!2sbd"
                        width="210" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12">
                        <!-- section title -->
        <div class="sec-title text-center mb50">
            <h2>محتاج مساعدة؟</h2>
            <div class="devider"><img src="{{ asset('home-page/img/skills-icon.webp') }}"
                    alt="ايقونة شعار سكيلز آرتس لتصميم بروفايل الشركات">
                <!-- small image icon between divider -->
            </div>
        </div>
        <!-- / section title -->
                <div class="contact-form">
                    <h3>أطلب وتدلل</h3>
                    <form action="{{ route('contact.store') }}" id="" method="POST">
                        @csrf
                        <div class="form-group d-flex justify-content-between">
                            <div class="input-field">
                                <input dir="rtl" type="text" name="name" id="name" placeholder="الأسم"
                                    class="form-control" value="{{ old('name') }}" required>
                            </div>
                            <div dir="rtl" class="input-field">
                                <input type="email" name="email" id="email" placeholder="بريدك الإلكتروني"
                                    class="form-control" value="{{ old('email') }}" required>

                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-between">
                            <div class="input-field">
                                <input dir="rtl" type="text" name="subject" id="subject" placeholder="العنوان"
                                    class="form-control" value="{{ old('subject') }}" required>
                            </div>
                            <div class="input-field">
                                <input dir="rtl" type="phone" name="phone" id="phone"
                                    placeholder="رقم الموبايل" class="form-control" value="{{ old('phone') }}"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea dir="rtl" name="message" id="message" placeholder="الرسالة" class="form-control" required>{{ old('message') }}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input class="form-check-input" name="terms" type="checkbox" value=""
                                    id="flexCheckDefault" required>
                                <label class="form-check-label" for="flexCheckDefault">
                                    يرجى الموافقة على <a href="https://skillsarts.com/page/Privacy-policy"
                                        class="text-danger">سياسة الخصوصية</a>
                                    <a href="https://skillsarts.com/page/terms-and-conditions" class="text-danger">و
                                        الشروط والأحكام</a>

                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-red" id="form-submit">
                                        ارسل استفسارك
                                    </button>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- end contact form -->

        </div>
    </div>
</div>
