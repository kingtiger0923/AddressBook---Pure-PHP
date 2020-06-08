$(document).ready(function () {
  $('.addrRec tr').click(function () {
    if ($(this).hasClass("rowSelected")) {
      $(this).removeClass("rowSelected");
    } else {
      $(this).addClass("rowSelected");
    }
  });

  $('.popClose').click(function () {
    $('.popup').fadeOut();
  });
});

function removeSelected() {
  var Sels = document.getElementsByClassName("rowSelected");
  if (Sels.length == 0) {
    alert("No Entry Selected");
    return;
  }
  var Args = [];
  for (var i = 0; i < Sels.length; i++) {
    var txt = $(Sels[i]).find(".rcId").text();
    Args.push(txt);
  }
  $.ajax({
    type: "POST",
    url: "_src/functions.php",
    dataType: 'json',
    data: { func: 'remove', arguments: [JSON.stringify(Args)] },
    success: function (res) {
      location.reload();
      if (res['error']) {
        alert(res['error']);
      }
    }
  });
}

function editSelected() {
  var Sels = document.getElementsByClassName("rowSelected");
  if (Sels.length != 1) {
    alert("Please Select one Entry");
    return;
  }

  var Selected = Sels[0];
  var cells = $(Selected).find('td');

  $('.popup .content .cell #name').val($(cells[1]).text());
  $('.popup .content .cell #firstName').val($(cells[2]).text());
  $('.popup .content .cell #email').val($(cells[3]).text());
  $('.popup .content .cell #street').val($(cells[4]).text());
  $('.popup .content .cell #zipCode').val($(cells[5]).text());
  $('.popup .content .cell #city').val($(cells[6]).text());
  $('.popup .content .cell #id').val($(cells[7]).text());
  $('.popup .popTitle').html("Edit Address");

  $('.popup').fadeIn();
}

function addNew() {

  $('.popup .content .cell #name').val("");
  $('.popup .content .cell #firstName').val("");
  $('.popup .content .cell #email').val("");
  $('.popup .content .cell #street').val("");
  $('.popup .content .cell #zipCode').val("");
  $('.popup .content .cell #city').val("");
  $('.popup .content .cell #id').val("");
  $('.popup .popTitle').html("Add New Address");

  $('.popup').fadeIn();
}

function Confirm() {
  if ($('.popup .content .cell #id').val() != "") {
    // Edit
    var Args = {
      name: $('.popup .content .cell #name').val(),
      firstName: $('.popup .content .cell #firstName').val(),
      email: $('.popup .content .cell #email').val(),
      street: $('.popup .content .cell #street').val(),
      zipCode: $('.popup .content .cell #zipCode').val(),
      city: $('.popup .content .cell #city').val(),
      id: $('.popup .content .cell #id').val(),
    }

    $.ajax({
      type: "POST",
      url: "_src/functions.php",
      dataType: 'json',
      data: { func: 'edit', arguments: [JSON.stringify(Args)] },
      success: function (res) {
        location.reload();
        if (res['error']) {
          alert(res['error']);
        }
      }
    });
  } else {
    // Add
    var Args = {
      name: $('.popup .content .cell #name').val(),
      firstName: $('.popup .content .cell #firstName').val(),
      email: $('.popup .content .cell #email').val(),
      street: $('.popup .content .cell #street').val(),
      zipCode: $('.popup .content .cell #zipCode').val(),
      city: $('.popup .content .cell #city').val(),
    }

    $.ajax({
      type: "POST",
      url: "_src/functions.php",
      dataType: 'json',
      data: { func: 'add', arguments: [JSON.stringify(Args)] },
      success: function (res) {
        location.reload();
        if (res['error']) {
          alert(res['error']);
        }
      }
    });
  }
  $('.popup').fadeOut();
}
