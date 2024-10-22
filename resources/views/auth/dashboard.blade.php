@extends('layouts.app')
@section('title','Dashboard')
@section('css')
  <link rel="stylesheet" href="{{asset('css/custom/account.css')}}">
@stop
@section('content')
<section class="account-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        @include('auth.navigation')
                    </div>
                </div>
                <!-- dashboard content -->
                <div class="tab-pane active" id="dash">
					<div class="row justify-content-center">
						<div class="col-md-10">
							<div class="card bg-dark">
								<div class="card-header">لوحة التحكم</div>
								<div class="card-body">
									<form method="POST" action="{{ route('user.update') }}">
									@csrf
										<div dir="rtl" class="row">
											<div class="col-md-6">
											   <div class="form-group">
												<label for="first_name">الأسم الأول</label>
												<input dir="rtl" value="{{Auth::user()->name}}" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="الإسم الأول" name="name" >
												@error('first_name')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											 </div>
											</div>
											<div class="col-md-6">
											   <div class="form-group">
												<label for="last_name">الأسم الأخير</label>
												<input dir="rtl" value="{{Auth::user()->last_name}}" type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" placeholder="الإسم الأخير" name="last_name"  >
												@error('last_name')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											  </div>
											</div>
											<div class="col-md-12">
											   <div class="form-group">
												<label for="email">الإيميل</label>
												<input dir="rtl" value="{{Auth::user()->email}}"  type="text" class="form-control bg-transparent" id="email" placeholder="الإيميل" readonly>
											  </div>
											</div>
											<div class="col-md-12">
											   <div class="form-group">
												<label for="address">العنوان</label>
												<input dir="rtl" value="{{Auth::user()->address}}" type="text" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="العنوان" name="address" >
												@error('address')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											  </div>
											</div>
											{{-- <div class="col-md-6">
											   <div class="form-group">
												<label for="state">المحافظة</label>
												<input value="{{Auth::user()->state}}" type="text" class="form-control @error('state') is-invalid @enderror" id="state" placeholder="المحافظة" name="state" >
												@error('state')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											  </div>
											</div>  --}}
											<div class="col-md-12">
											   <div class="form-group">
												<label for="phone">رقم الجوال</label>
												<input dir="rtl" value="{{Auth::user()->phone}}" type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="موبايل" name="phone" >
												@error('phone')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											  </div>
											</div>
											 {{-- <div class="col-md-6">
											   <div class="form-group">
                                                <label for="city">المدينة</label>
                                                <select class="form-control" name="city" id="city">
                                                    <option value=''>اختر المدينة</option>
                                                    <option value='Sharurah'>Sharurah</option>
                                                    <option value='AlBaha'>AlBaha</option>
                                                    <option value='AlMakhwah'>AlMakhwah</option>
                                                    <option value='Baljurashi'>Baljurashi</option>
                                                    <option value='AlAflaj'>AlAflaj</option>
                                                    <option value='Al-Badie Al-Shamali '>Al-Badie Al-Shamali </option>
                                                    <option value='Layla'>Layla</option>
                                                    <option value='Dumat alJandal'>Dumat alJandal</option>
                                                    <option value='zalom'>zalom</option>
                                                    <option value='Sakakah'>Sakakah</option>
                                                    <option value='Abo Ajram'>Abo Ajram</option>
                                                    <option value='Uyun al jawa'>Uyun al jawa</option>
                                                    <option value='Buraidah'>Buraidah</option>
                                                    <option value='Ain Dar'>Ain Dar</option>
                                                    <option value='Anak'>Anak</option>
                                                    <option value='Bahrain Causeway'>Bahrain Causeway</option>
                                                    <option value='Ras Tannurah'>Ras Tannurah</option>
                                                    <option value='Athuqbah'>Athuqbah</option>
                                                    <option value='Jubail'>Jubail</option>
                                                    <option value='Khobar'>Khobar</option>
                                                    <option value='Dammam'>Dammam</option>
                                                    <option value='Dhahran'>Dhahran</option>
                                                    <option value='AlAwamiyah'>AlAwamiyah</option>
                                                    <option value='AlQatif'>AlQatif</option>
                                                    <option value='Buqayq'>Buqayq</option>
                                                    <option value='Tarut'>Tarut</option>
                                                    <option value='Saihat'>Saihat</option>
                                                    <option value='Safwa'>Safwa</option>
                                                    <option value='AlQudaih'>AlQudaih</option>
                                                    <option value='Dawadmi'>Dawadmi</option>
                                                    <option value='Ar Ruwaidhah'>Ar Ruwaidhah</option>
                                                    <option value='Sajir'>Sajir</option>
                                                    <option value='Afïf'>Afïf</option>
                                                    <option value='Dhahran Al Janub'>Dhahran Al Janub</option>
                                                    <option value='Najran'>Najran</option>
                                                    <option value='AbuAreesh'>AbuAreesh</option>
                                                    <option value='Ahad AlMasarihah'>Ahad AlMasarihah</option>
                                                    <option value='Al Tuwal'>Al Tuwal</option>
                                                    <option value='Bish'>Bish</option>
                                                    <option value='Jizan'>Jizan</option>
                                                    <option value='Samtah'>Samtah</option>
                                                    <option value='Sabya'>Sabya</option>
                                                    <option value='Ḍamad'>Ḍamad</option>
                                                    <option value='Hali AlQunfudhah'>Hali AlQunfudhah</option>
                                                    <option value='hail'>hail</option>
                                                    <option value='Qaisumah'>Qaisumah</option>
                                                    <option value='hafar alBatin'>hafar alBatin</option>
                                                    <option value='Udhayliyah'>Udhayliyah</option>
                                                    <option value='Uthmaniyah'>Uthmaniyah</option>
                                                    <option value='AlUyun'>AlUyun</option>
                                                    <option value='AlMubarraz'>AlMubarraz</option>
                                                    <option value='Hassa'>Hassa</option>
                                                    <option value='Batha'>Batha</option>
                                                    <option value='Salwa'>Salwa</option>
                                                    <option value='AlJumoom'>AlJumoom</option>
                                                    <option value='Bahrah'>Bahrah</option>
                                                    <option value='Thwal'>Thwal</option>
                                                    <option value='Jeddah'>Jeddah</option>
                                                    <option value='Rabigh'>Rabigh</option>
                                                    <option value='Nairiyah'>Nairiyah</option>
                                                    <option value='Qarya Al Uliya'>Qarya Al Uliya</option>
                                                    <option value='AlKhafji'>AlKhafji</option>
                                                    <option value='Abha'>Abha</option>
                                                    <option value='Ahad Rafidah'>Ahad Rafidah</option>
                                                    <option value='Sabt AlUlayah'>Sabt AlUlayah</option>
                                                    <option value='Namas'>Namas</option>
                                                    <option value='Bisha'>Bisha</option>
                                                    <option value='Khamis Mushait'>Khamis Mushait</option>
                                                    <option value='Mahail'>Mahail</option>
                                                    <option value='Bariq'>Bariq</option>
                                                    <option value='Jash'>Jash</option>
                                                    <option value='Majardah'>Majardah</option>
                                                    <option value='Nakeea'>Nakeea</option>
                                                    <option value='Darb/abha'>Darb/abha</option>
                                                    <option value='Rijal Alma'>Rijal Alma</option>
                                                    <option value='Sarat Abideh'>Sarat Abideh</option>
                                                    <option value='Tathlith'>Tathlith</option>
                                                    <option value='Wadi Bin Hashbal'>Wadi Bin Hashbal</option>
                                                    <option value='AlKharj'>AlKharj</option>
                                                    <option value='AdDilam'>AdDilam</option>
                                                    <option value='Hotat Bani Tamim'>Hotat Bani Tamim</option>
                                                    <option value='Al Hulwah'>Al Hulwah</option>
                                                    <option value='Al Hariq'>Al Hariq</option>
                                                    <option value='Al Lith'>Al Lith</option>
                                                    <option value='AlMajmaah'>AlMajmaah</option>
                                                    <option value='Ghat'>Ghat</option>
                                                    <option value='Hawtat Sudayr'>Hawtat Sudayr</option>
                                                    <option value='Medina'>Medina</option>
                                                    <option value='AlUla'>AlUla</option>
                                                    <option value='Al Jafr'>Al Jafr</option>
                                                    <option value='Mecca'>Mecca</option>
                                                    <option value='AlBadai'>AlBadai</option>
                                                    <option value='AlBukayriyah'>AlBukayriyah</option>
                                                    <option value='AlKhabra'>AlKhabra</option>
                                                    <option value='Zulfi'>Zulfi</option>
                                                    <option value='AlMidhnab'>AlMidhnab</option>
                                                    <option value='Riyadh AlKhabra'>Riyadh AlKhabra</option>
                                                    <option value='Unaizah'>Unaizah</option>
                                                    <option value='AlQunfudhah'>AlQunfudhah</option>
                                                    <option value='AlQuz'>AlQuz</option>
                                                    <option value='Arar'>Arar</option>
                                                    <option value='Rafha'>Rafha</option>
                                                    <option value='Uqlat As Suqur'>Uqlat As Suqur</option>
                                                    <option value='Dukhnah'>Dukhnah</option>
                                                    <option value='Al Dulaymiyah'>Al Dulaymiyah</option>
                                                    <option value='An Nabhaniyah'>An Nabhaniyah</option>
                                                    <option value='Rass'>Rass</option>
                                                    <option value='AdDiriyah'>AdDiriyah</option>
                                                    <option value='Riyadh'>Riyadh</option>
                                                    <option value='AlQuwayiyah'>AlQuwayiyah</option>
                                                    <option value='AlMuzahimiyah'>AlMuzahimiyah</option>
                                                    <option value='Huraymila '>Huraymila </option>
                                                    <option value='malham'>malham</option>
                                                    <option value='Salbukh'>Salbukh</option>
                                                    <option value='Rumah'>Rumah</option>
                                                    <option value='Dhurma'>Dhurma</option>
                                                    <option value='Shaqraa'>Shaqraa</option>
                                                    <option value='Alhawiyah'>Alhawiyah</option>
                                                    <option value='Taif'>Taif</option>
                                                    <option value='Turabah'>Turabah</option>
                                                    <option value='Ranyah'>Ranyah</option>
                                                    <option value='AlKhurmah'>AlKhurmah</option>
                                                    <option value='Tabuk'>Tabuk</option>
                                                    <option value='Tayma'>Tayma</option>
                                                    <option value='haql'>haql</option>
                                                    <option value='Ḍuba'>Ḍuba</option>
                                                    <option value='AlQurayyat'>AlQurayyat</option>
                                                    <option value='tabarjal'>tabarjal</option>
                                                    <option value='Turaif'>Turaif</option>
                                                    <option value='Taraf'>Taraf</option>
                                                    <option value='As Sulayyil'>As Sulayyil</option>
                                                    <option value='Wadi adDawasir'>Wadi adDawasir</option>
                                                    <option value='Badr'>Badr</option>
                                                    <option value='Yanbu'>Yanbu</option>
                                                    <option value='Ummluj'>Ummluj</option>
                                                    <option value='AlWajh'>AlWajh</option>
                                                </select>
                                                @error('city')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											 </div>
											</div>  --}}
											 {{-- <div class="col-md-12">
											   <div class="form-group">
												<label for="post_code">الرمز البريدي</label>
												<input value="{{Auth::user()->post_code}}" type="number" step="1" class="form-control @error('post_code') is-invalid @enderror" id="post_code" placeholder="الرمز البريدي" name="post_code" >
												@error('post_code')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											 </div>
											</div> --}}
											<div class="col-md-12">
											   <div class="form-group">
												<button class="btn btn-inline float-right" type="submit"> حفظ</button>
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
        </section>
@endsection

@section('javascript')
<script>
    $('#city').val("{{Auth::user()->city}}");
</script>
@endsection
