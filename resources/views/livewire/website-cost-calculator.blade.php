<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFour">
        <h4 class="panel-title">
            <a role="button">
                <i class="icon fab fa-internet-explorer"></i>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" value="true" id="websiteswitch" wire:model="checked">
                    <label class="custom-control-label" for="websiteswitch">موقع الكتروني</label>
                </div>
            </a>
        </h4>
    </div>
    <div dir="rtl" id="collapseFour" class="panel-collapse collapse @if($checked == true) show @endif" role="tabpanel" aria-labelledby="headingFour">
        @if($checked == true)
        <div class="panel-body">
            <div class="form-group">
                <label for="types">لوحة التحكم</label>
                <select dir="rtl" id="" name="website[type]" class="form-control bg-white text-dark border border-dark"
                    wire:model="websiteType">
                    <option value="">-- اختر نوع الموقع --</option>
                    @foreach ($website_types as $key =>$type)
                    <option value="{{$type['label']}}">{{$type['title']}}</option>
                    @endforeach
                </select>
            </div>
            @if($this->websiteType ==="With Dashboard"||$this->websiteType === "Without Dashboard")
            <div class="form-group">
                <label for="pages">عدد الصفحات {{$page}}</label>
                <input dir="rtl" type="range" class="form-control-range" name="website[pages]" wire:model="page">
            </div>
            <div class="form-group">
                <label for="languages">كم لغة {{$language}}</label>
                <input dir="rtl" type="range" class="form-control-range"  name="website[languages]" wire:model="language">
            </div>
            <div class="form-group">
                <label for="emails">عدد الإيميلات {{$email}}</label>
                <input dir="rtl" type="range" class="form-control-range" name="website[emails]" wire:model="email">
            </div>
            <div dir="rtl" class="custom-control custom-switch">
                <input class="custom-control-input" type="checkbox" name="website[features][]" value="Blog"  id="blog" wire:model="blog">
                <label dir="" class="custom-control-label" for="blog">يحتوي مدونة</label>
            </div>
            <div class="custom-control custom-switch">
                <input class="custom-control-input" type="checkbox" id="ecommerce" name="website[features][]" value="Ecommerce" wire:model="ecommerce">
                <label class="custom-control-label" for="ecommerce">متجر الكتروني</label>
            </div>
            <div class="custom-control custom-switch">
                <input class="custom-control-input" type="checkbox" id="online_payment" name="website[features][]" value="Online payment" wire:model="onlinePayment">
                <label class="custom-control-label" for="online_payment">وسائل دفع الكترونية</label>
            </div>
            <div class="custom-control custom-switch">
                <input class="custom-control-input" type="checkbox" id="online_shipping" name="website[features][]" value="Online shipping" wire:model="onlineShipping">
                <label class="custom-control-label" for="online_shipping">ربط الموقع بشركات الشحن</label>
            </div>
            @endif
            <hr>

            <h4 class="text-center text-danger">
                $<span class="total-cost">{{$total_cost}}</span>
              </h4>
            @endif
        </div>
    
    </div>
</div>
