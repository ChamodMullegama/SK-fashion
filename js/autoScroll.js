let scrollIntervals = {};
const scrollSpeed = 0.1;

function startAutoScroll(containerId) {
    let scrollDirection = 1;
    scrollIntervals[containerId] = setInterval(function () {
        const container = document.getElementById(containerId);
        const itemWidth = container.firstElementChild.offsetWidth;
        const scrollAmount = itemWidth * scrollDirection;
        container.scrollLeft += scrollAmount;
        if (container.scrollLeft >= container.scrollWidth - container.clientWidth) {
            scrollDirection = -1;
        } else if (container.scrollLeft <= 0) {
            scrollDirection = 1;
        }
    }, 2000);
}

function stopAutoScroll(containerId) {
    clearInterval(scrollIntervals[containerId]);
}

startAutoScroll('items_deals_BW_home');
startAutoScroll('items_deals_FH_home');

function scrollItems(containerId, direction) {
    const container = document.getElementById(containerId);
    const itemWidth = container.firstElementChild.offsetWidth;
    const scrollAmount = itemWidth * (direction === 'left' ? -1 : 1);
    container.scrollBy({
        left: scrollAmount,
        behavior: 'smooth'
    });
}