
$(document).ready(function(e) {
  //  kiem tra ket qua captcha
  var n1 = Math.round(Math.random() * 10 + 1);
  var n2 = Math.round(Math.random() * 10 + 1);
  $("#cau_hoi").val(n1 + " + " + n2);
  $get_value = $('input[type="text"]');
  $keyPress = e.keyCode;
  var text_max = 99;
  var text_max_2 = 3000;
  $('#count_message').html('Còn lại ' + text_max + ' kí tự!');
  $('#count_message_2').html('Còn lại ' + text_max_2 + ' kí tự!');
  // var slideIndex = 1;
  // showSlides(slideIndex);

  // Doi so thanh dinh dang tien
  $doi_menhgia = formatNumber($('#menh_gia').html(), '.', ',');
  $('#menh_gia').html($doi_menhgia);




  $(".numberOnly").keydown(function (event) {
    // Prevent shift key since its not needed
    if (event.shiftKey == true) {
      event.preventDefault();
    }
    // Allow Only: keyboard 0-9, numpad 0-9, backspace, tab, left arrow, right arrow, delete
    if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46) {

    } else {
        // Prevent the rest
        event.preventDefault();
      }
    });


  $(".form_register").submit(function () {
    if (eval($("#cau_hoi").val()) != $("#tra_loi").val()) {
      $("#tra_loi").css('box-shadow', '0px 0px 7px yellow');
      alert('Vui lòng nhập kết quả chính xác bằng số');
      return false;
    }
    else{
      $("#tra_loi").css('box-shadow', '0px 0px 0px');
    } 
  });


  $('#tieude').keyup(function() {
    var text_length = $('#tieude').val().length;
    var text_remaining = text_max - text_length;

    $('#count_message').html('Còn lại ' + '<p class="text-danger" style="display:inline;">'+ text_remaining + '</p>' + ' kí tự!');
  });

  $('#mota_soluoc').keyup(function() {
    var text_length = $('#mota_soluoc').val().length;
    var text_remaining = text_max_2 - text_length;

    $('#count_message_2').html('Còn lại ' + '<p class="text-danger" style="display:inline;">'+ text_remaining + '</p>' + ' kí tự!');
  });



  $("#gia_tien").keydown(function (event) {
    // Prevent shift key since its not needed
    if (event.shiftKey == true) {
      event.preventDefault();
    }
    // Allow Only: keyboard 0-9, numpad 0-9, backspace, tab, left arrow, right arrow, delete
    if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46) {
        
    } else {
        // Prevent the rest
        event.preventDefault();
    }
    

  });

  $("#gia_tien").keyup(function (event) {
    $gia_tien = formatNumber($(this).val(), '.', ',');
        $("#tieudeHelp1").text($gia_tien + ' VND');
        console.log($gia_tien);
  });



  $(function() {
      // Multiple images preview in browser
      var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
          var filesAmount = input.files.length;

          for (i = 0; i < filesAmount; i++) {
            var reader = new FileReader();

            reader.onload = function(event) {
              $($.parseHTML('<img>')).attr({'src':event.target.result,'width':150,'height':150}).appendTo(placeToInsertImagePreview);
            }

            reader.readAsDataURL(input.files[i]);
          }
        }

      };

      $('#customFile').on('change', function() {
        $(".gallery").find('img').remove();
        imagesPreview(this, 'div.gallery');
        // 
        // var numFiles = $('div.gallery').children('img').length;
        var num_of_images = $(this)[0].files.length;

        console.log(num_of_images);
        $('div.notice').text('Đã chọn ' + num_of_images + ' ảnh');
      });
    });
    

});

function formatNumber(nStr, decSeperate, groupSeperate) {
            nStr += '';
            x = nStr.split(decSeperate);
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
            }
            return x1 + x2;
}

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}


