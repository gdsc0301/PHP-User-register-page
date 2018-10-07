$(document).ready(function(){
  $.ajax({
    url: "get_profiles.php",
    method: "POST",
    data_type: "json",
    success: function(data){
      var users = JSON.parse(data);
      for(let user of users){
        AppendUsers(user);
      }
    }
  });
  
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
      success: function(data){
        var new_user_data = JSON.parse(data);
        console.log(new_user_data);
        AppendUsers(new_user_data);
      }
    });
  });
});

function AppendUsers(dataArray){
  var user_card =
  '<div class="ui raised card">'+
    '<div class="content">'+
      '<div class="header">'+
        dataArray.first_name + ' ' + dataArray.last_name + ' - ' + dataArray.age + ' anos'+
      '</div>'+
      '<div class="meta">'+
        dataArray.email +
      '</div>'+
    '</div>'+
    '<div class="extra-content">'+
      '<div class="ui two buttons">'+
        '<input class="ui basic yellow button" name="edit" type="button" value="Editar">'+
        '<input class="ui basic red button" name="delete" type="button" value="Excluir">'+
      '</div>'+
    '</div>'+
  '</div>';

  $("div.user-list").append(user_card);
}
