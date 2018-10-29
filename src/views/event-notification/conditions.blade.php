@isset($availableVariables)
    <table class="striped checkbox-s table-ss table-bordered">
        <thead id="stepTable"></thead>
        <span id="variableTitle">متغیرهای در دسترس</span><br>
        @foreach($availableVariables as $variable)
            <tr>
                <td class="conditionSteps">{{$variable->process_step['name']}}</td>
                <td><input type="radio" name="conditionStatus[{{$variable->process_step['id']}}]" value="0" checked>بدون
                    وابستگی
                </td>
                @foreach($variable->process_step['statuses'] as $statuses)
                    <td class="conditionStatuses"><input type="radio"
                                                         name="conditionStatus[{{$statuses->id}}]"
                                                         value="{{$statuses->id}}">{{$statuses->status_name}}
                    </td>
                @endforeach
            </tr>
            <span>{{$variable->description}}</span>
            <div class="globalVariables"> {{$variable->process_step['alias']}} | user | name ~~~~~~~ نام (گروه مشتری)
            </div>
            <div class="globalVariables"> {{$variable->process_step['alias']}} | user | cell ~~~~~~~ شماره همراه (گروه
                مشتری)
            </div>
            <div class="globalVariables"> {{$variable->process_step['alias']}} | user | bource_code ~~~~~~~ کدبورسی
                (گروه مشتری)
            </div>
            <div class="globalVariables"> {{$variable->process_step['alias']}} | status ~~~~~~~ وضعیت (گروه مشتری)</div>
            <div class="availableVariables"> {{$variable->process_step['alias']}} | {{$variable->alias}}</div>
        @endforeach
    </table>
@endisset
@isset($stepAdmins)
    <table class="striped checkbox-s table-ss table-bordered">
        <thead id="stepUser">

        </thead>
        @foreach($stepAdmins as $step)
            <tr>
                <td>{{$step->name}}</td>
                <td>{{$step->group['name']}}</td>
                <td>
                    <input type="checkbox" name="processMode[{{$step->id}}][]" value="0">عدم ارسال
                    <input type="checkbox" name="processMode[{{$step->id}}][]" value="1"> ارسال ایمیل
                    <input type="checkbox" name="processMode[{{$step->id}}][]" value="2"> ارسال پبامک
                    <input type="checkbox" name="processMode[{{$step->id}}][]" value="3">ارسال اعلان سیستمی
                </td>
            </tr>
        @endforeach
    </table>
@endisset
@isset($userGroups)
    <table class="striped checkbox-s table-ss table-bordered">
        <thead id="userGroup">

        </thead>
        @foreach($userGroups as $group)
            <tr>
                <td>{{$group->name }}({{ $group['admins']->count()}}نفر)</td>
                <td>
                    <input type="checkbox" name="groupMode[{{$group->id}}][]" value="0">عدم ارسال
                    <input type="checkbox" name="groupMode[{{$group->id}}][]" value="1"> ارسال ایمیل
                    <input type="checkbox" name="groupMode[{{$group->id}}][]" value="2"> ارسال پبامک
                    <input type="checkbox" name="groupMode[{{$group->id}}][]" value="3">ارسال اعلان سیستمی
                </td>
            </tr>
        @endforeach
    </table>
@endisset
@isset($admins)
    <table class="striped checkbox-s table-ss table-bordered">
        <thead id="admins">
        </thead>
        @foreach($admins as $admin)
            <tr>
                <td>{{$admin->name }}</td>
                <td>
                    <input type="checkbox" name="userMode[{{$admin->id}}][]" value="0">عدم ارسال
                    <input type="checkbox" name="userMode[{{$admin->id}}][]" value="1"> ارسال ایمیل
                    <input type="checkbox" name="userMode[{{$admin->id}}][]" value="2"> ارسال پبامک
                    <input type="checkbox" name="userMode[{{$admin->id}}][]" value="3">ارسال اعلان سیستمی
                </td>
            </tr>
        @endforeach
    </table>
@endisset

<div class="manualNotification" style="display: none">
    @for($i=0;$i<20;$i++)
        <input type="text" name="mobile[]" placeholder="شماره موبایل را وارد کنید">
        <input type="email" name="email[]" placeholder="ایمیل را وارد نمایید">
    @endfor
</div>


<textarea class="messageCreator" style="display: none"
          name="body" id="" cols="30" rows="10" placeholder="%create-request|user|name%|سلام .
        درخواست شما توسط اپراتور در تاریخ %request-view | date% بررسی شده و به زودی انجام میشود
"></textarea>
