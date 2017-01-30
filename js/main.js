// Console à zero
console.clear();

// Champs à zéro
function fieldStart()
{
  $('#account, #loginForm').find("input[type=text], input[type=password], textarea").val("");
}
setTimeout(fieldStart, 100);

// Changement des icones
function setIcon(id, set)
{
    if(set)
    {
      $(id).removeClass("glyphicon-remove");
      $(id).addClass("glyphicon-ok");
    }
    else
    {
      $(id).removeClass("glyphicon-ok");
      $(id).addClass("glyphicon-remove");
    }

    checkAll();
}

// Test des champs
function userInput(str)
{
  setIcon('#userInputHelp', (str.match(/[0-9]/) || !str.trim()) ? false : true);
}

function checkEmail(str)
{
  setIcon('#emailInputHelp', !str.match(/[a-z][a-z0-9_.]*@[a-z][a-z0-9_.]*\.[a-z]{2,4}/) ? false : true);
}

function checkDate(str)
{
  setIcon('#dateInputHelp', !str.match(/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/) ? false : true);
}

function checkSizeMax(str, id, size)
{
  setIcon('#' + id + 'Help', (str.trim().length > Number(size) || !str.trim()) ? false : true);
}

function checkSizeMin(str, id, size)
{
  setIcon('#' + id + 'Help', str.trim().length < Number(size) ? false : true);
}

function checkPass()
{
  var pass = $('#passInput').val().trim();
  var rePass = $('#rePassInput').val().trim();

  setIcon('.passInputHelp', ((pass != rePass) || !pass || !rePass) ? false : true);
}

function checkPassProfil()
{
  var pass = $('#passInputProfil').val().trim();
  var rePass = $('#rePassInputProfil').val().trim();

  setIcon('.passInputProfilHelp', (pass != rePass) ? false : true);
}

function checkEmpty(str, id)
{
  setIcon('#' + id + 'Help', !str.trim() ? false : true);
}

var checkArea = '';
function checkAll()
{
  $(checkArea + ' .valid').removeAttr("disabled");

  if($(checkArea + ' .glyphicon-remove').length >= 1)
  {
    if(this.innerHTML != '')
    $(checkArea + ' .valid').attr('disabled', 'disabled');
  }
}

// Les evénements
$('#userInput').keyup(function() {userInput(this.value);} );
$('#userInput').keydown(function() {userInput(this.value);} );
$('#userInput').keypress(function() {userInput(this.value);} );
$('#userInput').blur(function() {userInput(this.value);} );

$('#emailInput').keyup(function() {checkEmail(this.value);} );
$('#emailInput').keydown(function() {checkEmail(this.value);} );
$('#emailInput').keypress(function() {checkEmail(this.value);} );
$('#emailInput').blur(function() {checkEmail(this.value);} );

$('#dateInput').keyup(function() {checkDate(this.value);} );
$('#dateInput').keydown(function() {checkDate(this.value);} );
$('#dateInput').keypress(function() {checkDate(this.value);} );
$('#dateInput').blur(function() {checkDate(this.value);} );

$('#addName, #nameSlide').keyup(function() {checkSizeMax(this.value, this.id, $(this).data('size'));} );
$('#addName, #nameSlide').keydown(function() {checkSizeMax(this.value, this.id, $(this).data('size'));} );
$('#addName, #nameSlide').keypress(function() {checkSizeMax(this.value, this.id, $(this).data('size'));} );
$('#addName, #nameSlide').blur(function() {checkSizeMax(this.value, this.id, $(this).data('size'));} );

$('#addDescription, #descriptionSlide').keyup(function() {checkSizeMin(this.value, this.id, $(this).data('size'));} );
$('#addDescription, #descriptionSlide').keydown(function() {checkSizeMin(this.value, this.id, $(this).data('size'));} );
$('#addDescription, #descriptionSlide').keypress(function() {checkSizeMin(this.value, this.id, $(this).data('size'));} );
$('#addDescription, #descriptionSlide').blur(function() {checkSizeMin(this.value, this.id, $(this).data('size'));} );

$('#passInput, #rePassInput').keyup(function() {checkPass(this.value);} );
$('#passInput, #rePassInput').keydown(function() {checkPass(this.value);} );
$('#passInput, #rePassInput').keypress(function() {checkPass(this.value);} );
$('#passInput, #rePassInput').blur(function() {checkPass(this.value);} );

$('#passInputProfil, #rePassInputProfil').keyup(function() {checkPassProfil(this.value);} );
$('#passInputProfil, #rePassInputProfil').keydown(function() {checkPassProfil(this.value);} );
$('#passInputProfil, #rePassInputProfil').keypress(function() {checkPassProfil(this.value);} );
$('#passInputProfil, #rePassInputProfil').blur(function() {checkPassProfil(this.value);} );

$('#fullnameInput, #messageInput').keyup(function() {checkEmpty(this.value, this.id);} );
$('#fullnameInput, #messageInput').keydown(function() {checkEmpty(this.value, this.id);} );
$('#fullnameInput, #messageInput').keypress(function() {checkEmpty(this.value, this.id);} );
$('#fullnameInput, #messageInput').blur(function() {checkEmpty(this.value, this.id);} );

// Ajout d'un ami
function addFriend(obj, addId)
{
  $.post("../ajax/addFriend.php", { id: addId })
  .done(function(data)
  {
    if(data == 'OK')
    $(obj).attr('disabled', 'disabled');
  });
}

// Suppression d'un élément
function supprElm(id, get)
{
  $('#myModal').modal('show');
  $('#modalYes').click(function()
  {
      window.location = get + '=' + id;
  });
}

// Changement de configuration dans l'admin
$('#changeConfig').change(
  function()
  {
    window.location = 'admin.php?change=' + this.value;
  }
);

// Aperçu de la config
function previewConfig()
{
  var cNavBar = $('#colorNavBar').val().split(', ');
  $('#navBarPreview').css({'background-color' : 'rgba('+cNavBar[1]+', '+cNavBar[2]+', '+cNavBar[3]+', '+cNavBar[0]+')'});

  var cButton = $('#colorButton').val().split(', ');
  $('#btnPreview').css({'background-color' : 'rgba('+cButton[1]+', '+cButton[2]+', '+cButton[3]+', '+cButton[0]+')'});

  var cTitle = $('#colorTitle').val().split(', ');
  $('#titlePreview').css({'color' : 'rgba('+cTitle[1]+', '+cTitle[2]+', '+cTitle[3]+', '+cTitle[0]+')'});

  var cUrl = $('#colorUrl').val().split(', ');
  $('#urlPreview').css({'color' : 'rgba('+cUrl[1]+', '+cUrl[2]+', '+cUrl[3]+', '+cUrl[0]+')'});
}

$('#colorNavBar, #colorTitle, #colorUrl, #colorButton').keyup(function() {previewConfig();} );
$('#colorNavBar, #colorTitle, #colorUrl, #colorButton').keydown(function() {previewConfig();} );
$('#colorNavBar, #colorTitle, #colorUrl, #colorButton').keypress(function() {previewConfig();} );
$('#colorNavBar, #colorTitle, #colorUrl, #colorButton').blur(function() {previewConfig();} );
$('#fontTitle').change(function() {previewConfig();} );

// Modification des slides
$('#slideEdit').click(
  function()
  {
    var title = $('.item.active h2').html();
    var description = $('.item.active p').html();
    var id = $('.item.active').data('id');

    $('#nameSlide').val(title);
    $('#descriptionSlide').val(description);
    $('#id').val(id);

    $('#editForm').modal('show');
  }
);

// Ajout d'un slide
$('#slideAdd').click(
  function()
  {
    $('#addForm').modal('show');
  }
);

// Suppression d'un slide
$('#slideDel').click(
  function()
  {
    var id = $('.item.active').data('id');
    supprElm(id, 'index.php?supprSlide');
  }
);
