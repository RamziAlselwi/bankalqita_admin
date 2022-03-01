@component('mail::message')
<div dir="rtl">
<strong>
    مرحبا، {{$store->name}}
</strong>
<br>

أنت تتلقى هذا البريد الإلكتروني لأننا تلقينا طلب إعادة تعيين كلمة المرور لحسابك.
<br>
<br>
<div style="width: 100%; float: right; padding: 15px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
    <div style="width: 100%; float: right; padding: 15px; background: #f7f7f7; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
        <div style="width: 100%; float: right; padding: 30px 15px; border: 2px solid #fff; text-align: center; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
        <h3 style="font-size: 26px; margin-bottom: 15px; font-weight: normal; line-height: 26px; margin: 0; color: #333; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; font-family: 'Work Sans', Arial, Helvetica, sans-serif;">رمز التحقق الخاص بك هو:</h3>
        <h4 style="font-size: 18px; margin-top: 10px;">{{$store->otp}}</h4>
        </div>
    </div>
</div>
<br>
<br>
شكرا,<br>
{{ config('app.name', 'بنك القطع') }}
</div>

@endcomponent
  