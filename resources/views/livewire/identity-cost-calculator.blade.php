<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
        <h4 class="panel-title">
            <a role="button">
                <i class="icon fas fa-id-card-alt"></i>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" value="true" id="identityswitch"
                        wire:model="checked">
                    <label class="custom-control-label" for="identityswitch">هوية</label>
                </div>
            </a>
        </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse @if($checked == true) show @endif" role="tabpanel"
        aria-labelledby="headingThree">
        <div class="panel-body">
            <p>نصمم هوية لعلامتك التجارية بكل دقة واحترافية وبلمسات فنية تظهر علامتك التجارية بطريقة مميزة اختر عناصر الهوية التي تحتاجها من القائمة ادناه </p>
            <hr>

     
            @if($checked == true)
            @foreach ($items as $key => $item )
            <div class="custom-control custom-switch">
                <input class="custom-control-input" type="checkbox" id="{{$key}}"
                    value="{{ucwords(str_replace('_',' ',$key))}}" name="identity[]" wire:model="items.{{$key}}">
                <label class="custom-control-label" for="{{$key}}">{{ucwords(str_replace('_',' ',$key)) }}</label>
            </div>
            @endforeach
          <h4 class="text-center text-danger">
            $<span class="total-cost">{{$total_cost}}</span>
          </h4>
            @endif

        </div>
    </div>
</div>
