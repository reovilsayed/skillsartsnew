<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
        <h4 class="panel-title">
            <a role="button">
                <i class="icon fas fa-users"></i>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" value="true" id="profileswitch" wire:model="checked">
                    <label class="custom-control-label" for="profileswitch">البروفايل التعريفي</label>
                </div>
            </a>
        </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse @if($checked == true) show @endif" role="tabpanel" aria-labelledby="headingTwo">
        <div class="panel-body">
            <p>سنصمم لك بروفايل تعريفي احترافي ينافس كبرى الشركات ، يبدأ البروفايل بعدد ثمان صفحات ويمكنك من المتغيرات ادناه ان تتحكم بعدد الصفحات واللغة المطلوبة </p>

            <hr>
            @if($checked == true)
          
            <div class="form-group">
                <label for="pages">
                    عدد الصفحات {{$pages}}
                </label>
                <input type="range" name="profile[pages]" class="form-control-range" step="4" min="8" wire:model="pages">
            </div>
            <div class="custom-control custom-switch">
                <input class="custom-control-input" name="profile[language]" value="Arabic" type="checkbox" id="arabic" wire:model="arabic"
                    @if($arabicAndEnglish) disabled @endif>
                <label class="custom-control-label" for="arabic">اللغة العربية فقط</label>
            </div>
            <div class="custom-control custom-switch">
                <input class="custom-control-input" name="profile[language]" value="Arabic and English" type="checkbox" id="arabicAndEnglish" wire:model="arabicAndEnglish"
                    @if($arabic) disabled @endif>
                <label class="custom-control-label" for="arabicAndEnglish">لغتين عربية وانجليزية</label>
            </div>
            <hr>
            <h4 class="text-center text-danger">
                $<span class="total-cost">{{$total_cost}}</span>
              </h4>
            @endif
            
            
        </div>
    </div>
</div>
