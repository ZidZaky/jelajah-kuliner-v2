<?php $__env->startSection('title'); ?>
    ABOUT US?
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/aboutus.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
    <div class="content">
        <div class="up" style=" display: flex; justify-content: space-between; padding-top: 20px">
            <div class="back" style="text-align: center; margin-left: 20px;">
                <button class="btn btn-danger" onclick="window.location.href='/dashboard'; return false;">Back</button>

            </div>
            <div class="nmpkl" style="margin-left: 200px;">
                <p class="threeD"><strong>ABOUT US</strong></p>
            </div>
            <div class="upside" style="margin-right: 20px;">
                <p class="namaakun" style="text-align: right;">Want to Know us More? 😉</p>
            </div>
        </div>
        <hr id="hratas">
    </div>

    <div class="content" style="display: flex; flex-direction: column;">
        <div class="blue-cards" style="display: flex; justify-content: center; margin-bottom: 50px">
            <div class="card" style="">
                <img src="/assets/zidan.png" alt="" style="width: 150px; height: 150px;" class="border">
                <div class="desc">
                  <p>Zidan Irfan Zaky</p>
                  <p>1201220003</p>
                  <p>zidzaky@student.telkomuniversity.ac.id</p>
                  <button class="btn btn-success" id="whatsapp1">
                    <img src="/assets/whatsapp.png" alt="wa" style="width: 20px; margin-top: -3px">
                    Whatsapp Me!</button>
                </div>
              </div>
            </div>
        </div>

        <div class="green-cards" style="display: flex; justify-content: center; gap: 250px">
            <div class="card" style="">
                <img src="/assets/farhan.jpg" alt="" style="width: 150px; height: 150px;" class="border">
                <div class="desc">
                  <p>Farhan Nugraha Sasongko Putra</p>
                  <p>1201220449</p>
                  <p>farhantoosleepy@student.telkomuniversity.ac.id</p>
                  <button class="btn btn-success" id="whatsapp2">
                    <img src="/assets/whatsapp.png" alt="wa" style="width: 20px; margin-top: -3px">
                    Whatsapp Me!</button>
                </div>
            </div>
            <div class="card" style="">
                <img src="/assets/evi.jpg" alt="" style="width: 150px; height: 150px;" class="border">
                <div class="desc">
                  <p>Evi Fitriya</p>
                  <p>1201220005</p>
                  <p>evifitriya@student.telkomuniversity.ac.id</p>
                  <button class="btn btn-success" id="whatsapp3">
                    <img src="/assets/whatsapp.png" alt="wa" style="width: 20px; margin-top: -3px">
                    Whatsapp Me!</button>
                </div>
            </div>
            <div class="card" style="">
                <img src="/assets/dika.jpg" alt="" style="width: 150px; height: 150px;" class="border">
                <div class="desc">
                  <p>Radinka Putra Rahadian</p>
                  <p>1201220020</p>
                  <p>radinka@student.telkomuniversity.ac.id</p>
                  <button class="btn btn-success" id="whatsapp4">
                    <img src="/assets/whatsapp.png" alt="wa" style="width: 20px; margin-top: -3px">
                    Whatsapp Me!</button>
                </div>
            </div>
        </div>
      </div>
      
      
      <script>
        // Define an array to store the links for each button
        const whatsappLinks = [
          'https://wa.me/62088989694349', // Link for whatsapp1
          'https://wa.me/62081238474150', // Link for whatsapp2
          'https://wa.me/6208972529100', // Link for whatsapp3
          'https://wa.me/62081553399607' // Link for whatsapp4
        ];
      
        // Add event listeners to each button using querySelectorAll
        const whatsappButtons = document.querySelectorAll('.btn-success');
        whatsappButtons.forEach((button, index) => {
          button.addEventListener('click', () => {
            const newTabLink = document.createElement('a');
            newTabLink.href = whatsappLinks[index]; // Use the link at the corresponding index
            newTabLink.target = '_blank';
            newTabLink.click();
          });
        });
      </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\KULIAH\PIPL\jelajah-kuliner\resources\views/aboutus.blade.php ENDPATH**/ ?>