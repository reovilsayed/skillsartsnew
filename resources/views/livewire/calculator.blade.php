<div>

    <div class="panel-group " id="accordion" role="tablist" aria-multiselectable="true">

        @if($services != null && array_key_exists('logo',$services))
        <livewire:logo-cost-calculator :logo="$services!=null?json_encode($services['logo']):null" />
        @else
        <livewire:logo-cost-calculator />
        @endif
        @if($services != null && array_key_exists('profile',$services))
        <livewire:profile-cost-calculator :profile="$services!=null?json_encode($services['profile']):null" />
        @else
        <livewire:profile-cost-calculator />
        @endif
        @if( $services != null && array_key_exists('identity',$services))
        <livewire:identity-cost-calculator :identity="$services!=null?json_encode($services['identity']):null" />
        @else
        <livewire:identity-cost-calculator />
        @endif
        @if( $services != null && array_key_exists('website',$services))
        <livewire:website-cost-calculator :website="$services!=null?json_encode($services['website']):null">
        @else
        <livewire:website-cost-calculator>
        @endif




      
            <input type="hidden" name="total" id="totalInput" value="{{$total}}">
            <div class="panel panel-default">
                <h1 class="text-center text-danger">
                    $ <span id="total">{{$total}}</span>
                </h1>



            </div>
    </div>
  
</div>
