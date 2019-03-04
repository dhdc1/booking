<style>

    .box-x {        
        width: 280px;
        height: 130px;
        text-align: center;        
        cursor: pointer;
        margin: 15px;

    }

</style>

<div style="display:flex;flex-direction: column;align-items: center;">
    <div id='btnBooking' class="box-x" style="  background-color: #db4865">
        <span style="font-size: 32px;color: white;">จองนัดเข้ารับบริการ</span><br>
        <span style="font-size: 32px;color: white;">Booking</span>        
    </div>
    <div id='btnCheck' class="box-x" style="  background-color: #f4b042">
        <span style="font-size: 32px;color: #002752">ตรวจสอบจองนัด</span><br>
        <span style="font-size: 32px;color: #002752">Check Queue</span>
    </div>
    <div id='btnRegister' class="box-x" style="  background-color: #00b3ee">
        <span style="font-size: 32px;color: #002752">ลงทะเบียนรายใหม่</span><br>
        <span style="font-size: 32px;color: #002752">Register</span>
    </div>
</div>
<?php
$this->registerJs($this->render('script.js'));

