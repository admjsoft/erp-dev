
$(document).ready(function(){
    

    
    $("body").delegate("#pass-btn", "click", function(){
        $(".pass-info").toggle();
    });

    
    $("body").delegate("#bank-btn", "click", function(){
        $(".bank-info").toggle();
    });

    $("#edit-pickup-details").click(function(){
        $(".pickup-field").show();
        $("#edit-pickup-details-submit").show();
        $(".pickup-details-hide").hide();
        $("#edit-pickup-details").hide();
    
    });
    
    $("#edit-dropoff-details").click(function(){
        $(".dropoff-field").show();
        $("#edit-dropoff-details-submit").show();
        $(".dropoff-details-hide").hide();
        $("#edit-dropoff-details").hide();
    });
    
    
    
});


(function() {
  var page_load = true;
  $("#purchase_orders_daterange").daterangepicker({
      forceUpdate: true,
      callback: function(startDate, endDate, period) {
          var title = startDate.format('L') + ' – ' + endDate.format('L');
          $(this).val(title);
          load_purchase_orders_table(title,page_load);
          page_load = false;
      }
  });
}());

(function() {
  var page_load = true;
  $("#employees_daterange").daterangepicker({
      forceUpdate: true,
      callback: function(startDate, endDate, period) {
          var title = startDate.format('L') + ' – ' + endDate.format('L');
          $(this).val(title);
          load_employee__table(title,page_load);
          page_load = false;
      }
  });
}());

(function() {
  var page_load = true;
  $("#job_applicants_daterange").daterangepicker({
      forceUpdate: true,
      callback: function(startDate, endDate, period) {
          var title = startDate.format('L') + ' – ' + endDate.format('L');
          $(this).val(title);
          load_job_applicants_table(title,page_load);
          page_load = false;
      }
  });
}());


(function() {
  var page_load = true;
  $("#promotions_daterange").daterangepicker({
      forceUpdate: true,
      callback: function(startDate, endDate, period) {
          var title = startDate.format('L') + ' – ' + endDate.format('L');
          $(this).val(title);
          load_promotions_table(title,page_load);
          page_load = false;
      }
  });
}());

(function() {
  var page_load = true;
  $("#messaging_hub_daterange").daterangepicker({
      forceUpdate: true,
      callback: function(startDate, endDate, period) {
          var title = startDate.format('L') + ' – ' + endDate.format('L');
          $(this).val(title);
          load_messaging_hub__table(title,page_load);
          page_load = false;
      }
  });
}());

$(function() {



  // $('#purchase_orders_daterange').daterangepicker({
  //     opens: 'left'
  // })

  // $('#employees_daterange').daterangepicker({
  //   opens: 'left'
  // })

  // $('#job_applicants_daterange').daterangepicker({
  //   opens: 'left'
  // })

 

  
 

});

  var myDates = [];
  for (var j = 0; j <= 11; j++) {
    myDates[j] = [];
  }
  $(function () {
    $('#calendars1').datepicker();
    //initCalendar();
  });
  $(function () {
    $('#calendars').datepicker();
    //initCalendar();
  });

$(document).ready(function () {
  $(".mapshow").click(function () {
    $(".listview").hide();
    $(".mapview").show();
  });
  $(".listshow").click(function () {
    $(".listview").show();
    $(".mapview").hide();
  });
});
 



// function initCalendar() {
//   $('div.ui-widget-header').append('\
//     <a class="ui-datepicker-clear-month" title="Clear month">\
//         X\
//     </a>\
// ');

//   var thisMonth = $($($('#calendar tbody tr')[2]).find('td')[0]).attr('data-month');
//   var dateDragStart = undefined; // We'll use this variable to identify if the user is mouse button is pressed (if the user is dragging over the calendar)
//   var thisDates = [];
//   var calendarTds = $('.ui-datepicker-calendar td:not(.ui-datepicker-unselectable)');
//   $('#calendar td').attr('data-event', '');
//   $('#calendar td').attr('data-handler', '');
//   $('#calendar td a').removeClass('ui-state-active');
//   $('#calendar td a.ui-state-highlight').removeClass('ui-state-active').removeClass('ui-state-highlight').removeClass('ui-state-hover');
//   $('#calendar td').off();
//   for (var i = 0; i < myDates[thisMonth].length; i++) { // Repaint
//     var a = calendarTds.find('a').filter('a:textEquals(' + myDates[thisMonth][i].getDate() + ')').addClass('ui-state-active');
//     thisDates.push(new Date(a.parent().attr('data-year'), thisMonth, a.html()));
//   }

//   $('#calendar td').mousedown(function () {  // Click or start of dragging
//     dateDragStart = new Date($(this).attr('data-year'), $(this).attr('data-month'), $(this).find('a').html());
//     $(this).find('a').addClass('ui-state-active');
//     return false;
//   });

//   $('#calendar td').mouseup(function () {
//     thisDates = [];
//     $('#calendar td a.ui-state-active').each(function () { //Save selected dates
//       thisDates.push(new Date($(this).parent().attr('data-year'), $(this).parent().attr('data-month'), $(this).html()));
//     });
//     dateDragStart = undefined;
//     return false;
//   });
//   $(document).mouseup(function () {
//     dateDragStart = undefined;
//   });

//   $('#calendar td').mouseenter(function () {  // Drag over day on calendar
//     var thisDate = new Date($(this).attr('data-year'), $(this).attr('data-month'), $(this).find('a').html());
//     if (dateDragStart !== undefined && thisDate > dateDragStart) {  // We are dragging forwards
//       for (var d = new Date(dateDragStart); d <= thisDate; d.setDate(d.getDate() + 1)) {
//         calendarTds.find('a').filter('a:textEquals(' + d.getDate() + ')').addClass('ui-state-active');
//       }
//       $(this).find('a').addClass('ui-state-active');
//     } else if (dateDragStart !== undefined && thisDate < dateDragStart) {  // We are dragging backwards
//       for (var d = new Date(dateDragStart); d >= thisDate; d.setDate(d.getDate() - 1)) {
//         calendarTds.find('a').filter('a:textEquals(' + d.getDate() + ')').addClass('ui-state-active');
//       }
//       $(this).find('a').addClass('ui-state-active');
//     }
//   });

//   $('#calendar td').mouseleave(function () {
//     var thisDate = new Date($(this).attr('data-year'), $(this).attr('data-month'), $(this).find('a').html());
//     if (dateDragStart !== undefined && thisDate > dateDragStart) {
//       for (var d = new Date(dateDragStart); d <= thisDate; d.setDate(d.getDate() + 1)) {
//         if (thisDates.find(item => item.getTime() == d.getTime()) === undefined) {
//           calendarTds.find('a').filter('a:textEquals(' + d.getDate() + ')').removeClass('ui-state-active');
//         }
//       }
//     } else if (dateDragStart !== undefined && thisDate < dateDragStart) {
//       for (var d = new Date(dateDragStart); d >= thisDate; d.setDate(d.getDate() - 1)) {
//         if (thisDates.find(item => item.getTime() == d.getTime()) === undefined) {
//           calendarTds.find('a').filter('a:textEquals(' + d.getDate() + ')').removeClass('ui-state-active');
//         }
//       }
//     }
//   });

//   $('.ui-datepicker-clear-month').click(function () {
//     thisDates = [];
//     calendarTds.find('a').removeClass('ui-state-active');
//   });

//   $('a.ui-datepicker-next, a.ui-datepicker-prev').click(function () {
//     myDates[thisMonth] = thisDates;
//     initCalendar();
//   });
// }

// $.expr[':'].textEquals = function (el, idx, selector) {
//   var regExp = new RegExp('^' + selector[3] + '$');
//   return regExp.test($(el).text());
// };

var dropdown = document.getElementsByClassName("sub-nav");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function () {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}

(function () {
    const header = document.querySelector('.header');
    const icon = document.querySelector('.icon-container');
    icon.onclick = function () {
      header.classList.toggle('menu-open');
    }
}());


function readURL(input) {
  if (input.files && input.files[0]) {


    var file = input.files[0];

  // Check if the file type is a PNG or JPG/JPEG image
  if (!(file.type === 'image/png' || file.type === 'image/jpeg' || file.type === 'image/jpg')) {
        
        swal("Please select a PNG or JPG/JPEG image file.", {
          icon: "error",
        });
        // Reset the file input element
        $(this).val('');
        return false;
    }else{
      var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }


      
  }
}



function readURL1(input) {
  if (input.files && input.files[0]) {


    var file = input.files[0];

  // Check if the file type is a PNG or JPG/JPEG image
  if (!(file.type === 'image/png' || file.type === 'image/jpeg' || file.type === 'image/jpg')) {
        
        swal("Please select a PNG or JPG/JPEG image file.", {
          icon: "error",
        });
        // Reset the file input element
        $(this).val('');
        return false;
    }else{
      var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah1').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }


      
  }
}

function readURL2(input) {
  if (input.files && input.files[0]) {


    var file = input.files[0];

  // Check if the file type is a PNG or JPG/JPEG image
  if (!(file.type === 'image/png' || file.type === 'image/jpeg' || file.type === 'image/jpg')) {
        
        swal("Please select a PNG or JPG/JPEG image file.", {
          icon: "error",
        });
        // Reset the file input element
        $(this).val('');
        return false;
    }else{
      var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah2').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }


      
  }
}

jQuery(document).ready(function () {
  ImgUpload();
});

function ImgUpload() {
  var imgWrap = "";
  var imgArray = [];

  $('.upload__inputfile').each(function () {
    $(this).on('change', function (e) {

      $('#MultipleDefault').hide();
      $('#existing_merchant_item_images').hide();
      
      imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
      var maxLength = $(this).attr('data-max_length');

      var files = e.target.files;
      var filesArr = Array.prototype.slice.call(files);
      var iterator = 0;
      filesArr.forEach(function (f, index) {

        if (!f.type.match('image.*')) {
          return;
        }

        if (imgArray.length > maxLength) {
          return false
        } else {
          var len = 0;
          for (var i = 0; i < imgArray.length; i++) {
            if (imgArray[i] !== undefined) {
              len++;
            }
          }
          if (len > maxLength) {
            return false;
          } else {
            imgArray.push(f);

            var reader = new FileReader();
            reader.onload = function (e) {
              var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
              imgWrap.append(html);
              iterator++;
            }
            reader.readAsDataURL(f);
          }
        }
      });
    });
  });

  // $('body').on('click', ".upload__img-close", function (e) {
  //   var file = $(this).parent().data("file");
  //   for (var i = 0; i < imgArray.length; i++) {
  //     if (imgArray[i].name === file) {
  //       imgArray.splice(i, 1);
  //       break;
  //     }
  //   }
  //   $(this).parent().parent().remove();
  // });

  $(document).ready(function() {
    $('input[type="number"]').on('input', function(e) {
      // Prevent alphabets and special characters from being typed
      $(this).val(function(i, val) {
        return val.replace(/[^0-9]/g, '');
      });
    });
    
    // Disable scrolling on text inputs
    $('input[type="number"]').on('wheel', function(e) {
      e.preventDefault();
    });
  });

  // const toggleSwitch = document.querySelector('#toggle');
  // const content = document.querySelector('#content');

  // toggleSwitch.addEventListener('change', () => {
  //   if (toggleSwitch.checked) {
  //     content.style.display = 'block';
  //   } else {
  //     content.style.display = 'none';
  //   }
  // });

}

// ClassicEditor
// .create( document.querySelector( '#editor' ) )
// .catch( error => {
//     console.error( error );
// } );


// html date picker date format change

//     $("input").on("change", function() {
//         if(this.value !='') {
//     this.setAttribute(
//         "data-date",
//         moment(this.value, "YYYY-MM-DD")
//         .format( this.getAttribute("data-date-format") )
//     )
// } else {
    
// }
// }).trigger("change")
    
// html date picker date format change