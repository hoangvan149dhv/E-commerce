<footer class="ftco-footer">
    <div class="container">
        <div class="row mb-5">
            <div class="col-sm-12 col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2 logo"><a href="#">Sunny <span>Ngo</span></a></h2>
                    <ul class="ftco-footer-social list-unstyled mt-2">
                        <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md">
                <div class="ftco-footer-widget mb-4 ml-md-4">
                    <h2 class="ftco-heading-2">Thông tin</h2>
                    <ul class="list-unstyled">
                        <li><a href="{{ URL::to('/lien-he') }}"><span class="fa fa-chevron-right mr-2"></span>Về chúng
                                tôi</a></li>
                        <li><a href="{{ URL::to('/lien-he') }}"><span class="fa fa-chevron-right mr-2"></span>Liên
                                hệ</a></li>
                        <li><a href="{{ URL::to('/lien-he') }}"><span class="fa fa-chevron-right mr-2"></span>Tuyển dụng</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Quick Link</h2>
                    <ul class="list-unstyled">
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>New User</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Hỗ trợ</a></li>
                        <li><a href="#" data-toggle="modal"
                               data-target="#reportBug"><span class="fa fa-chevron-right mr-2"></span>Báo lỗi</a></li>
                    </ul>
                </div>
            </div>
            <div class="modal fade" id="reportBug" tabindex="-1" role="dialog"
                 aria-labelledby="reportBugLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="reportBugLabel">Báo cáo lỗi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ URL::to('/lien-he') }}"
                              method="post">
                            <div class="modal-body">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Họ tên:</label>
                                    <input data-validation="length" data-validation-length="5-70"
                                           class="form-control"
                                           data-validation-error-msg='vui lòng điền tối đa 70 kí tự'
                                           type="text" name="name"
                                           placeholder="Họ tên"/>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Email:</label>
                                    <input data-validation="length" data-validation-length="5-100"
                                           class="form-control"
                                           data-validation-error-msg='vui lòng điền tối đa 100 kí tự'
                                           type="email" name="email"
                                           placeholder="Email"/>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Nội dung:</label>
                                    <textarea class="form-control" name="content"
                                              data-validation="length" data-validation-length="1-1000"
                                              data-validation-error-msg='Vui lòng điền tối đa 1000 ký tự'
                                              placeholder="Nội dung"></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Đóng
                                </button>
                                <button type="submit" name="submit" class="btn btn-primary">Gửi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Have a Questions?</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon fa fa-map-marker"></span><span
                                    class="text">@foreach ($contactinfoModel as $contact) {{ $contact->info_contact_add}} @endforeach</span>
                            </li>
                            <li><a href="tel:{{ $contact->info_contact_phone }}"><span
                                        class="icon fa fa-phone"></span><span
                                        class="text"> {{ $contact->info_contact_phone }} </span></a></li>
                            <li><a href="mailto:{{ $contact->info_contact_mail }}"><span
                                        class="icon fa fa-envelope pr-4"></span><span
                                        class="text">{{ $contact->info_contact_mail }}</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid px-0 py-5 bg-black">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <p class="mb-0" style="color: rgba(255,255,255,.5);">Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- loader -->
<div id="ftco-loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00"/>
    </svg>
</div>
