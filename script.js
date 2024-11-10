let words = document.querySelectorAll(".word");
words.forEach((word)=>{
    let letters = word.textContent.split("");
    word.textContent="";
    letters.forEach((letter)=>{
        let span = document.createElement("span");
        span.textContent = letter;
        span.className = "letter";
        word.append(span);
    });
});

let curentWordIndex = 0;
let maxWordIndex  = words.length - 1;

words[curentWordIndex].style.opacity = "1";

let changeText = ()=>{
    let currentWord = words[curentWordIndex];
    let nextWord = curentWordIndex == maxWordIndex ? words[0]  : words[curentWordIndex+1];
    Array.from(currentWord.children).forEach((letter,i)=>{
        setTimeout(()=>{
            letter.className = "letter out";
        }, i*80);
    });

nextWord.style.opacity="1";
Array.from(nextWord.children).forEach((letter,i)=>{
    letter.className = "letter behind";

    setTimeout(() => {
        letter.className = "letter in";
    }, 340 + i * 80);
});

 curentWordIndex = curentWordIndex === maxWordIndex ? 0 : curentWordIndex + 1 ;

};

changeText();
setInterval(changeText,3000);


// Typing Effect 

const sentences = [
    "Ankush Raj Mahe Yam",
    "Bestech By Ankush Raj Mahe Yam",
    "Gamend By Ankush Raj Mahe Yam",
    "Filmedia By Ankush Raj Mahe Yam",
  ];
  
  const spanTyping = document.getElementById("typing");
  let currentSentence = 0;
  let typingSpeed = 100; // Adjustable typing speed
  let erasingSpeed = 50; // Adjustable erasing speed
  
  function typeSentence() {
    const sentence = sentences[currentSentence];
    let index = 0;
  
    const typeChar = () => {
      if (index < sentence.length) {
        spanTyping.textContent += sentence.charAt(index); // Use textContent for efficiency
        index++;
        setTimeout(typeChar, typingSpeed);
      } else {
        setTimeout(eraseSentence, 1000); // Wait a second before erasing
      }
    };
  
    typeChar();
  }
  
  function eraseSentence() {
    const sentence = sentences[currentSentence];
    let index = sentence.length;
  
    const eraseChar = () => {
      if (index > 0) {
        spanTyping.textContent = sentence.substring(0, index - 1); // Use textContent
        index--;
        setTimeout(eraseChar, erasingSpeed);
      } else {
        currentSentence = (currentSentence + 1) % sentences.length; // Circular loop
        setTimeout(typeSentence, typingSpeed); // Start next sentence
      }
    };
  
    eraseChar();
  }
  
  typeSentence();





  // circle skill

  const circles = document.querySelectorAll('.circle');
   circles.forEach(elem=>{
    var dots = elem.getAttribute("data-dots");
    var marked = elem.getAttribute("data-percent");
    var percent = Math.floor(dots*marked/100);
    var points = "";
    var rotate = 360 / dots;

    for(let i = 0 ; i < dots ; i++){
      points += `<div class="points" style="--i:${i}; --rot:${rotate}deg"></div>`;
    }
    elem.innerHTML = points;


    const pointsMarked = elem.querySelectorAll('.points');
    for (let i = 0; i < percent; i++) {
      pointsMarked[i].classList.add('marked')
      
    }
   })


   // mix it up portfolio section 

   var mixer = mixitup('.portfolio-gallery'); 

  //  Menu avtive

  let menuLi = document.querySelectorAll('header ul li a');
  let section = document.querySelectorAll('section');

  function activeMenu(){
    let len = section.length;
    while(--len && window.scrollY + 97 < section[len].offsetTop){}
    menuLi.forEach(sec => sec.classList.remove("active"));
    menuLi[len].classList.add('active');
  }

  activeMenu();
  window.addEventListener("scroll", activeMenu);



// sticky navbar

const header = document.querySelector("header");
window.addEventListener("scroll", function(){
  header.classList.toggle("sticky", window.scrollY > 50)
})