const fadeIns = document.querySelectorAll(".fade-in");
const isHomePage = Boolean(document.querySelector(".hero"));

if (isHomePage) {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("is-visible");
      }
    });
  }, { threshold: 0.2 });

  fadeIns.forEach((el) => observer.observe(el));
} else {
  fadeIns.forEach((el) => el.classList.add("is-visible"));
}

document.querySelectorAll(".news__list").forEach((list) => {
  list.querySelectorAll(".news__item").forEach((item) => {
    const date = item.querySelector(".news__date")?.textContent ?? "";
    if (/XX/.test(date)) {
      item.classList.add("news__item--placeholder");
    }
  });
});

const heroSlides = document.querySelectorAll(".hero__slide");
if (heroSlides.length > 1) {
  let activeIndex = 0;
  setInterval(() => {
    heroSlides[activeIndex].classList.remove("is-active");
    activeIndex = (activeIndex + 1) % heroSlides.length;
    heroSlides[activeIndex].classList.add("is-active");
  }, 5000);
}

const shopCarousel = document.querySelector(".shop__carousel");
const shopGrid = document.querySelector(".shop__grid");
const shopPrev = document.querySelector(".shop__arrow--prev");
const shopNext = document.querySelector(".shop__arrow--next");

if (shopCarousel && shopGrid && shopPrev && shopNext) {
  const getScrollStep = () => {
    const card = shopGrid.querySelector(".shop__card");
    if (!card) return shopGrid.clientWidth;
    const gap = parseFloat(getComputedStyle(shopGrid).gap) || 12;
    return card.offsetWidth + gap;
  };

  const updateShopArrows = () => {
    const maxScroll = shopGrid.scrollWidth - shopGrid.clientWidth;
    const hasOverflow = maxScroll > 1;

    shopCarousel.classList.toggle("has-nav", hasOverflow);
    shopPrev.disabled = !hasOverflow || shopGrid.scrollLeft <= 1;
    shopNext.disabled = !hasOverflow || shopGrid.scrollLeft >= maxScroll - 1;
  };

  shopPrev.addEventListener("click", () => {
    shopGrid.scrollBy({ left: -getScrollStep(), behavior: "smooth" });
  });

  shopNext.addEventListener("click", () => {
    shopGrid.scrollBy({ left: getScrollStep(), behavior: "smooth" });
  });

  shopGrid.addEventListener("scroll", updateShopArrows, { passive: true });
  window.addEventListener("resize", updateShopArrows);
  updateShopArrows();
}
