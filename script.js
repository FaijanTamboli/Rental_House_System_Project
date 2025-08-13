window.onload = () => {
  const menuBar = document.querySelector('.menu-bar');
  const navItems = document.querySelectorAll('.nav-item');
  const verticalBox = document.querySelector('.vertical-box');
  const textContainer = document.querySelector('.text-container');

  // Menu bar animation
  gsap.from(menuBar, {
    duration: 1,
    y: -50,
    opacity: 0,
    ease: "power3.out"
  });

  // Nav items animation
  gsap.from(navItems, {
    duration: 1,
    opacity: 0,
    stagger: 0.2,
    x: -20,
    ease: "power3.out"
  });
};
