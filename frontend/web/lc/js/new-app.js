document.addEventListener("DOMContentLoaded", () => {
  function initializeAccordions() {
    const SPEED = 0.3;

    const openAccordion = (element) => {
      gsap.to(element, {
        height: "auto",
        duration: SPEED,
        // onComplete: () => ScrollTrigger.refresh(),
      });
    };
    const closeAccordion = (element) => {
      gsap.to(element, {
        height: 0,
        duration: SPEED,
        // onComplete: () => ScrollTrigger.refresh(),
      });
    };

    document.addEventListener("click", (event) => {
      if (
        event.target.matches(".js-accordion-btn") ||
        event.target.closest(".js-accordion-btn")
      ) {
        const btn = event.target.matches(".js-accordion-btn")
          ? event.target
          : event.target.closest(".js-accordion-btn");
        const element = btn.closest(".js-accordion");
        const content = element.querySelector(".js-accordion-content");
        const elements = Array.from(document.querySelectorAll(".js-accordion"));

        // event.preventDefault();

        if (element.hasAttribute("data-close-other")) {
          elements.forEach((otherElement) => {
            if (otherElement !== element) {
              if (otherElement.classList.contains("active")) {
                const content = otherElement.querySelector(
                  ".js-accordion-content"
                );
                closeAccordion(content);
                otherElement.classList.remove("active");
              }
            }
          });
        }

        if (element.classList.contains("active")) {
          closeAccordion(content);
        } else {
          openAccordion(content);
        }
        element.classList.toggle("active");
      }
    });
  }

  initializeAccordions();

  const accBtns = Array.from(document.querySelectorAll(".js-accordion-btn"));

  accBtns.forEach((btn) => {
    if (btn.parentElement.classList.contains("active")) btn.click();
  });

  const onlyNumericInputs = Array.from(
    document.querySelectorAll(".js-numeric-input-decimals")
  );

  onlyNumericInputs.forEach((input) => {
    input.addEventListener("input", () => {
      const value = input.value;
      const newCleanedValue = parseInt(value.replace(/[^\d]+/g, ""), 10);
      if (isNaN(newCleanedValue)) {
        input.value = "";
      } else {
        input.value = newCleanedValue.toLocaleString();
      }
    });
  });

  let timer = null;
  function startTimer() {
    var minute = 29;
    var sec = 59;
    if (timer) {
      clearInterval(timer);
    }
    timer = setInterval(function () {
      document.querySelector(".js-countdown").innerHTML =
        minute.toString().padStart(2, "0") +
        ":" +
        sec.toString().padStart(2, "0");
      sec--;
      if (sec == -1) {
        minute--;
        sec = 59;
        if (minute == 0) {
          minute = 0;
        }
      }
    }, 1000);
  }

  window.startTimer = startTimer;

  var timer_in_process=false
  const payUsdtBtn = document.querySelector(".js-pay-usdt-btn");
  const payUsdtBlock = document.querySelector(".js-pay-usdt-block");

  const payRubleBtn = document.querySelector(".js-pay-ruble-btn");
  const payRubleBlock = document.querySelector(".js-pay-ruble-block");

  if (payUsdtBtn && payUsdtBlock) {
    payUsdtBtn.addEventListener("click", (event) => {
      event.preventDefault();
      payRubleBtn.classList.remove("active");
      payRubleBlock.classList.remove("active");
      payRubleBlock.classList.add("hidden");

      payUsdtBtn.classList.add("active");
      payUsdtBlock.classList.remove("hidden");
      payUsdtBlock.classList.add("active");
      if(!timer_in_process)
      {
        startTimer();
        timer_in_process=true;
      }
    });
    payRubleBtn.addEventListener("click", (event) => {
      event.preventDefault();
      payUsdtBtn.classList.remove("active");
      payUsdtBlock.classList.remove("active");
      payUsdtBlock.classList.add("hidden");

      payRubleBtn.classList.add("active");
      payRubleBlock.classList.remove("hidden");
      payRubleBlock.classList.add("active");
      startTimer();
    });
  }

  const moneyrequest_usdt = document.querySelector(".moneyrequest_usdt");
  const moneyrequest_rub = document.querySelector(".moneyrequest_rub");
  const moneyrequest_usdt_btn = document.querySelector(".moneyrequest_usdt_btn");
  const moneyrequest_rub_btn = document.querySelector(".moneyrequest_rub_btn");
  const moneyrequest_type = document.querySelector(".moneyrequest_type");
  if (moneyrequest_usdt_btn && moneyrequest_rub_btn) {
    moneyrequest_usdt_btn.addEventListener("click", (event) => {
      event.preventDefault();
      moneyrequest_rub.classList.remove("active");
      moneyrequest_rub.classList.add("hidden");
      moneyrequest_rub_btn.classList.remove("active");

      moneyrequest_usdt.classList.remove("hidden");
      moneyrequest_usdt.classList.add("active");
      moneyrequest_usdt_btn.classList.add("active");

      moneyrequest_type.value='usdt'
    });

    moneyrequest_rub_btn.addEventListener("click", (event) => {
      event.preventDefault();
      moneyrequest_usdt.classList.remove("active");
      moneyrequest_usdt.classList.add("hidden");
      moneyrequest_usdt_btn.classList.remove("active");

      moneyrequest_rub.classList.remove("hidden");
      moneyrequest_rub.classList.add("active");
      moneyrequest_rub_btn.classList.add("active");
      moneyrequest_type.value='rub'
    });
  }



  function tabs() {
    const elements = Array.from(document.querySelectorAll(".js-tabs"));

    elements.forEach((element) => {
      const btns = Array.from(element.querySelectorAll(".js-tabs-btn"));
      const items = Array.from(element.querySelectorAll(".js-tabs-item"));

      const setActiveTab = (index) => {
        btns.forEach((btn) => btn.classList.remove("active"));
        items.forEach((item) => item.classList.remove("active"));

        btns[index].classList.add("active");
        items[index].classList.add("active");
      };

      if (items.length) {
        const activeIndex = btns.findIndex((btn) =>
          btn.classList.contains("active")
        );

        if (activeIndex !== -1) {
          setActiveTab(activeIndex);
        }
      }

      btns.forEach((btn, btnIndex) => {
        btn.addEventListener("click", (event) => {
          event.preventDefault();
          setActiveTab(btnIndex);
        });
      });
    });
  }

  tabs();

  function modals() {
    window.activeModal = null;

    function openModal(id, event) {
      const modal = document.querySelector(`.js-modal${id}`);
      if (!modal) {
        // console.error(`Modal with ID: ${id} not found`);
        return;
      }

      if (typeof window.closeMenu === "function") {
        window.closeMenu();
      }

      if (event) {
        event.preventDefault();
      }

      console.log("Opening modal", modal);

      const openHandler = () => {
        modal.classList.add("active");
        document.body.classList.add("modal-open");
        window.activeModal = modal;

        const openModalEvent = new CustomEvent("openmodal");
        document.dispatchEvent(openModalEvent);
      };
      if (window.activeModal) {
        closeModal(window.activeModal);

        setTimeout(() => {
          openHandler();
        }, 400);
      } else {
        openHandler();
      }
    }

    function closeModal(modal) {
      document.body.classList.remove("modal-open");

      modal.classList.remove("active");

      window.activeModal = null;

      const closeModalEvent = new CustomEvent("closemodal");
      document.dispatchEvent(closeModalEvent);
    }

    window.openModal = openModal;

    window.closeModal = closeModal;

    document.addEventListener("click", (event) => {
      if (event.target.matches("a") || event.target.closest("a")) {
        const link = event.target.matches("a")
          ? event.target
          : event.target.closest("a");
        const hash = link.hash;
        if (!hash) return;
        openModal(hash, event);
      } else if (
        event.target.matches(".js-close-modal") ||
        event.target.closest(".js-close-modal")
      ) {
        event.preventDefault();
        const modalToClose = event.target.closest(".js-modal");
        closeModal(modalToClose);
      } else if (event.target.matches(".js-modal")) {
        event.preventDefault();
        const modalToClose = event.target;
        closeModal(modalToClose);
      }
    });

    document.addEventListener("keydown", function (event) {
      if (event.which === 27 && window.activeModal) {
        closeModal(window.activeModal);
      }
    });
  }

  modals();

 /* const copyToClipboard = (str) => {
    const el = document.createElement("textarea");
    el.value = str;
    el.setAttribute("readonly", "");
    el.style.position = "absolute";
    el.style.left = "-9999px";
    document.body.appendChild(el);
    el.select();
    document.execCommand("copy");
    document.body.removeChild(el);
  };

  function linkCopy() {
    const elements = Array.from(document.querySelectorAll(".js-copy-link"));

    elements.forEach((element) => {
      element.addEventListener("click", (event) => {
        event.preventDefault();

        copyToClipboard(element.getAttribute("data-copy-text"));

        if (window.showMessage) {
          window.showMessage("#link-copied");
        }
      });
    });
  }

  linkCopy();*/

  if($('#success_popup').length){
    openModal('#success_popup','');
  }
});
