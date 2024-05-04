// Load the animation
const animationContainer = document.getElementById('animation-container');
const animData = {
    container: animationContainer,
    renderer: 'svg',
    loop: true,
    autoplay: true,
    path: '../animation.json'
};
const anim = lottie.loadAnimation(animData);