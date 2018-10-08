$(document).ready(function(){
  $.ajax({
    url: "get_profiles.php",
    method: "POST",
    data_type: "json",
    data: {'type' : 'get_all'},
    success: function(data){
      if(data != undefined || data != ""){
        var users = JSON.parse(data);
        for(let user of users){
          AppendUsers(user);
        }
      }
    }
  });

  /*Send user register*/
  $(".user-registration").on("submit", function(e){
    e.preventDefault();
    var postData = {
      'first_name' : $("input[name='first_name']").val(),
      'last_name'  : $("input[name='last_name']").val(),
      'email'      : $("input[name='email']").val(),
      'age'        : $("input[name='age']").val()
    };

    $.ajax({
      url:"registration.php",
      method: "POST",
      data: postData,
      success: function(){
        console.log(postData['email']);
        AppendUserByEmail(postData['email']);
      }
    });
  });

  /*USER EDITING FORM CONTROLL*/
  $(document).on("click", "input[name='edit']", function(e){
    var targetId = $(e.target).attr('id');
    console.log(e);
    $("div.user-edit-form[id="+targetId+"]").toggleClass("hidden");
  });

  $(document).on("click", "input[name='delete']",function(e){
    var targetId = $(e.target).attr('id');
    $.ajax({
      url: "user_editing.php",
      method: "POST",
      data: {'type':'delete', 'id':targetId},
      success: function(id){
        $("div.ui.card.fluid#" + id).remove();
      }
    })

  });

  /*EACH USER DATA EDITING*/
  /*FIRST NAME*/
  $(document).on("click", "button.first_name_submit", function(e){
    var header = $(e.target).parent().parent();
    var targetId = header.attr("id");
    var value = $(e.target).prev().val();

    var values = {
      'type' : 'first_name',
      'id'   : targetId,
      'data' : value};

    $.ajax({
      url:'user_editing.php',
      method:"post",
      data: values,
      success: function (data) {
        var newData = JSON.parse(data);
        $(e.target).prev().val("");
        $(".ui.card#" + newData.user_id + " div.header").html(newData.first_name + " " + newData.last_name + " - " + newData.age);
      }
    });
  });
  /* END */

  /*LAST NAME*/
  $(document).on("click", "button.last_name_submit", function(e){
    var targetId = $(e.target).parent().parent().attr('id');
    var value = $(e.target).prev().val();

    var values = {
      'type' : 'last_name',
      'id'   : targetId,
      'data' : value};

    $.ajax({
      url:'user_editing.php',
      method:"post",
      data: values,
      success: function(data) {
        var newData = JSON.parse(data);
        $(e.target).val("");
        $(".ui.card#" + newData.user_id + " div.header").html(newData.first_name + " " + newData.last_name + " - " + newData.age);
      }
    });
  });
  /* END */

  /* AGE */
  $(document).on("click", "button.age_submit", function(e){
    var targetId = $(e.target).parent().parent().attr('id');
    var value = $(e.target).prev().val();

    var values = {
      'type' : 'age',
      'id'   : targetId,
      'data' : value};

    $.ajax({
      url:'user_editing.php',
      method:"post",
      data: values,
      success: function (data) {
        var newData = JSON.parse(data);
        $(e.target).val("");
        $(".ui.card#" + newData.user_id + " div.header").html(newData.first_name + " " + newData.last_name + " - " + newData.age);
      }
    });
  });
  /* END */

  /* EMAIL */
  $(document).on("click", "button.email_submit", function(e){
    var targetId = $(e.target).parent().parent().attr('id');
    var value = $(e.target).prev().val();

    var values = {
      'type' : 'email',
      'id'   : targetId,
      'data' : value};

    $.ajax({
      url:'user_editing.php',
      method:"post",
      data: values,
      success: function (data) {
        console.log(data);
        var newData = JSON.parse(data);
        $(e.target).val("");
        $(".ui.card#" + newData.user_id + " div.meta").html(newData.email);
      }
    });
  });
  /* END */
});

function AppendUserByEmail(userEmail){
  $.ajax({
    url: 'get_profiles.php',
    method: 'post',
    data: {'type':'get_by_email', 'email': userEmail},
    success: function(data){
      var newData = JSON.parse(data);
      console.log(newData);
      AppendUsers(newData);
    }
  });
}

function AppendUsers(data){
  if(data == "" || data == undefined){
    return false;
  }
  var user_card =
  '<div class="ui raised card fluid" id="'+data.user_id+'">'+
    '<div class="content">'+
      '<div class="header">'+
        data.first_name + " " + data.last_name + " - " + data.age + " anos"+
      '</div>'+
      '<div class="meta">'+data.email+'</div>'+

      '<!-- Editing form -->'+
      '<div class="ui user-edit-form padded fluid segment hidden" id="'+data.user_id+'">'+
        '<h4 class="ui header dividing"> Edit this profile</h4>'+
        '<div class="ui mini action input">'+
          '<input type="text" class="first_name" placeholder="Primeiro Nome">'+
          '<button type="button" class="ui button first_name_submit">OK</button>'+
        '</div>'+
        '<div class="ui mini action input">'+
          '<input type="text" class="last_name" placeholder="Último Nome">'+
          '<button type="button" class="ui button last_name_submit">OK</button>'+
        '</div>'+
        '<div class="ui mini action input">'+
          '<input type="email" class="email" placeholder="Email" required>'+
          '<button type="button" class="ui button email_submit">OK</button>'+
        '</div>'+
        '<div class="ui mini action input">'+
          '<input type="number" class="age" placeholder="Idade" required>'+
          '<button type="button" class="ui button age_submit">OK</button>'+
        '</div>'+
      '</div>'+
      '<!--END-->'+

    '</div>'+
    '<div class="extra-content">'+
      '<div class="ui two buttons d">'+
        '<input class="ui basic yellow button" id="'+data.user_id+'" type="button" name="edit" value="Editar">'+
        '<input class="ui basic red button" id="'+data.user_id+'" type="button" name="delete" value="Excluir">'+
      '</div>'+
    '</div>'+
  '</div>';

  $("div.user-list div.ui.cards").prepend(user_card);
}
