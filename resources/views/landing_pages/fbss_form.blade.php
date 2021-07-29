<form action="">
{{--Start Neck--}}
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <legend class="text-black-50">Do you have neck pain?</legend>
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <div class="form-check form-check-inline">
            <input class="form-check-input ml-5" type="radio" name="neck_pain" id="neck_pain_1"
                   value="Yes">
            <label class="form-check-label" style="font-weight: normal !important; font-size: 80%"
                   for="neck_pain_1">Yes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="neck_pain" id="neck_pain_2"
                   value="No">
            <label class="form-check-label" style="font-weight: normal !important; font-size: 80%"
                   for="neck_pain_2">No</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <h3 class="col-form-label">Please rate your neck pain from 1-10</h3>
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        @php
            $count=1
        @endphp
        @while($count < 11)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="neck_pain_level"
                       id="neck_pain_level_{{$count}}" value="{{$count}}">
                <label class="form-check-label"
                       style="font-weight: normal !important; font-size: 80%"
                       for="neck_pain_level_{{$count}}">{{$count}}</label>
            </div>
            @php
                $count++
            @endphp
        @endwhile
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <h3 class="col-form-label">Are you also experiencing arm pain?</h3>
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="arm_pain" id="arm_pain_1"
                   value="Yes">
            <label class="form-check-label" style="font-weight: normal !important; font-size: 80%"
                   for="arm_pain_1">Yes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="arm_pain" id="arm_pain_2"
                   value="No">
            <label class="form-check-label" style="font-weight: normal !important; font-size: 80%"
                   for="arm_pain_2">No</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <h3 class="col-form-label">Please rate your arm pain from 1-10</h3>
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        @php
            $count=1
        @endphp
        @while($count < 11)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="arm_pain_level"
                       id="arm_pain_level_{{$count}}" value="{{$count}}">
                <label class="form-check-label"
                       style="font-weight: normal !important; font-size: 80%"
                       for="arm_pain_level_{{$count}}">{{$count}}</label>
            </div>
            @php
                $count++
            @endphp
        @endwhile
    </div>
</div>
{{--End Neck--}}
{{--Start Back--}}
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <legend class="text-black-50 pt-3">Do you have back pain?</legend>
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="back_pain" id="back_pain_1"
                   value="Yes">
            <label class="form-check-label" style="font-weight: normal !important; font-size: 80%"
                   for="back_pain_1">Yes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="back_pain" id="back_pain_2"
                   value="No">
            <label class="form-check-label" style="font-weight: normal !important; font-size: 80%"
                   for="back_pain_2">No</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <h3 class="col-form-label">Please rate your back pain from 1-10</h3>
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        @php
            $count=1
        @endphp
        @while($count < 11)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="back_pain_level"
                       id="back_pain_level_{{$count}}" value="{{$count}}">
                <label class="form-check-label"
                       style="font-weight: normal !important; font-size: 80%"
                       for="back_pain_level_{{$count}}">{{$count}}</label>
            </div>
            @php
                $count++
            @endphp
        @endwhile
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <h3 class="col-form-label">Are you also experiencing leg pain?</h3>
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="leg_pain" id="leg_pain_1"
                   value="Yes">
            <label class="form-check-label" style="font-weight: normal !important; font-size: 80%"
                   for="leg_pain_1">Yes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="leg_pain" id="leg_pain_2"
                   value="No">
            <label class="form-check-label" style="font-weight: normal !important; font-size: 80%"
                   for="leg_pain_2">No</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <h3 class="col-form-label">Please rate your leg pain from 1-10</h3>
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        @php
            $count=1
        @endphp
        @while($count < 11)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="leg_pain_level"
                       id="leg_pain_level_{{$count}}" value="{{$count}}">
                <label class="form-check-label"
                       style="font-weight: normal !important; font-size: 80%"
                       for="leg_pain_level_{{$count}}">{{$count}}</label>
            </div>
            @php
                $count++
            @endphp
        @endwhile
    </div>
</div>
{{--End Back--}}
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <legend class="text-black-50 pt-3">Have you had any of the following imaging done?</legend>
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        @php
            $arr = ['x_ray' => 'X-Ray', 'mri' => 'MRI', 'ct_scan' => 'CT Scan', 'emg_ncv' => 'EMG/NCV', 'none' => 'None']
        @endphp
        @foreach($arr as $k => $v)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="imaging_{{$k}}"
                       id="imaging_{{$k}}" value="{{$v}}">
                <label class="form-check-label"
                       style="font-weight: normal !important; font-size: 80%"
                       for="imaging_{{$k}}">{{$v}}</label>
            </div>
        @endforeach
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <legend class="text-black-50 pt-3">Have you had any of the following treatment?</legend>
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        @php
            $arr = ['treatments_chiropractic' => 'Chiropractic', 'treatments_therapy' => 'Physical, Massage or Aqua Therapy', 'treatments_opm' => 'Oral Pain Management', 'treatments_esi' => 'Epidural Steroid Injection', 'treatments_mbb' => 'Medical Branch Blocks', 'treatments_ra' => 'Radiofrequency Ablation', 'treatments_id' => 'Intradiscal Decompression']
        @endphp
        @foreach($arr as $ks => $vs)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="treatments_{{$ks}}"
                       id="treatments_{{$ks}}" value="{{$vs}}">
                <label class="form-check-label"
                       style="font-weight: normal !important; font-size: 80%"
                       for="treatments_{{$ks}}">{{$vs}}</label>
            </div>
        @endforeach
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <legend class="text-black-50 pt-3">What email should we send the results to?</legend>
    </div>
</div>
<div class="row">
    <div class="col col-md-5 col-lg-4 offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <input type="text" class="form-control form-control-sm">
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <legend class="text-black-50 pt-3">Would you be interested in discussing spine treatment
            options with one of our specialists?
        </legend>
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <div class="form-check form-check-inline">
            <input class="form-check-input ml-5" type="radio" name="contact" id="contact_1"
                   value="Yes">
            <label class="form-check-label" style="font-weight: normal !important; font-size: 80%"
                   for="contact_1">Yes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="contact" id="contact_2"
                   value="No">
            <label class="form-check-label" style="font-weight: normal !important; font-size: 80%"
                   for="contact_2">No</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <h3 class="col-form-label">What phone number can we call/text you at?</h3>
    </div>
</div>
<div class="row">
    <div class="col col-md-5 col-lg-4 offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <input type="text" name="phone" class="phone form-control form-control-sm">
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <h3 class="col-form-label">First Name</h3>
    </div>
</div>
<div class="row">
    <div class="col col-md-5 col-lg-4 offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <input type="text" name="first_name" class="form-control form-control-sm">
    </div>
</div>
<div class="row">
    <div class="col offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <h3 class="col-form-label">Last Name</h3>
    </div>
</div>
<div class="row">
    <div class="col col-md-5 col-lg-4 offset-0 offset-md-2 offset-lg-2 offset-xl-2">
        <input type="text" name="last_name" class="form-control form-control-sm">
    </div>
</div>
</form>
