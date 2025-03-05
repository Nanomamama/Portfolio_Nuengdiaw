// การจัดการเมนู
const menuTrigger = document.querySelector(".menu-trigger"),
  closeTrigger = document.querySelector(".close"),
  giveClass = document.querySelector(".site");

menuTrigger.addEventListener("click", function () {
  giveClass.classList.toggle("showmenu");
});

closeTrigger.addEventListener("click", function () {
  giveClass.classList.toggle("showmenu");
});

// การพิมพ์ข้อความแบบวนลูป
const textElement = document.getElementById("typing-text");

// ลิสต์ของข้อความที่จะวนแสดง
const textList = [
  "Full-Stack Developer",
  "Programmer",
  "Senior Programmer",
  "Application Developer",
  "iOS Developer",
  "Android Developer",
  "Java Developer",
  "Front-end Developer",
  "Test Engineer",
  "E-Commerce Developer",
  "VB Developer",
  "PHP Programmer",
  "Software Tester",
  "Software Engineer",
  "Project Manager",
];

let textIndex = 0; // ดัชนีของข้อความปัจจุบัน
let charIndex = 0; // ดัชนีของตัวอักษร
let isTyping = true; // สถานะว่ากำลังพิมพ์หรือลบ

function typeLoop() {
  const currentText = textList[textIndex]; // ข้อความปัจจุบัน

  if (isTyping) {
    // พิมพ์ข้อความทีละตัว
    if (charIndex < currentText.length) {
      textElement.textContent = currentText.slice(0, charIndex + 1);
      charIndex++;
      setTimeout(typeLoop, 100); // ความเร็วในการพิมพ์
    } else {
      // เมื่อพิมพ์ครบ หยุดพักแล้วเปลี่ยนไปลบ
      isTyping = false;
      setTimeout(typeLoop, 1000); // หยุดพักก่อนลบ
    }
  } else {
    // ลบข้อความทีละตัว
    if (charIndex > 1) {
      textElement.textContent = currentText.slice(0, charIndex - 1);
      charIndex--;
      setTimeout(typeLoop, 50); // ความเร็วในการลบ
    } else {
      // เมื่อลบหมด เปลี่ยนข้อความใหม่แล้วเริ่มพิมพ์
      isTyping = true;
      textIndex = (textIndex + 1) % textList.length; // วนลูปกลับไปข้อความแรกเมื่อถึงตัวสุดท้าย
      setTimeout(typeLoop, 500); // หยุดพักก่อนเริ่มข้อความใหม่
    }
  }
}

// เริ่มการพิมพ์ข้อความ
typeLoop();
