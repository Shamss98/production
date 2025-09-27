@component('mail::message')
# أهلاً {{ $user->name }}!

نورتنا — شكراً لإنضمامك إلينا.  
نحن سعداء بوجودك هنا.

@component('mail::button', ['url' => url('/')])
زور الموقع
@endcomponent

تحياتنا،  
فريق الدعم
@endcomponent
