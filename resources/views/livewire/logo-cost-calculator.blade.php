
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
            <a role="button">
                <i class="icon fa fa-draw-polygon"></i>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="logoswitch" value="true" wire:model="checked">
                    <label class="custom-control-label" for="logoswitch">تصميم شعار - لوجو</label>
                </div>
            </a>
        </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse @if($checked == true) show @endif  " role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
            <p>يسعدنا ثقتك بنا ومتحمسون لأن نقدم لك شعار إحترافي يتناسب مع طبيعة عملك، السعر شامل عدد ثلاث نماذج يمكنك طلب المزيد من خلال المتغير ادناه: </p>

            <div>
                <hr>
                @if($checked == true)
                <div class="form-group">
                    <label for="concept_number">عدد النماذج {{$concepts}}</label>
                    <input type="range" name="logo[concepts]" class="form-control-range" min="3" wire:model="concepts" value="">
                </div>
                <h4 class="text-center text-danger">
                  $ <span class="total-cost">{{$total_cost}}</span>
                </h4>
                @endif
            </div>
        </div>
    </div>
</div>
