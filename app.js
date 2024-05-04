$(document).ready(function() {
  const $signInBtn = $("#sign-in-btn");
  const $signUpBtn = $("#sign-up-btn");
  const $container = $(".container");

  $signUpBtn.on("click", function() {
      $container.addClass("sign-up-mode");
  });

  $signInBtn.on("click", function() {
      $container.removeClass("sign-up-mode");
  });
});