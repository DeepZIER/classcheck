// function startCountdown() {
//   const countdowns = document.querySelectorAll(".countdown");
//   countdowns.forEach((cd) => {
//     const endTime = new Date(cd.dataset.time).getTime();
//     if (!endTime || isNaN(endTime)) return;

//     const interval = setInterval(() => {
//       const now = new Date().getTime();
//       const distance = endTime - now;

//       if (distance <= 0) {
//         cd.innerText = "Waktu habis";
//         clearInterval(interval);
//       } else {
//         const h = Math.floor((distance / (1000 * 60 * 60)) % 24);
//         const m = Math.floor((distance / (1000 * 60)) % 60);
//         const s = Math.floor((distance / 1000) % 60);
//         cd.innerText = `${h}j ${m}m ${s}d`;
//       }
//     }, 1000);
//   });
// }
// startCountdown();

function startCountdown() {
  const countdowns = document.querySelectorAll(".countdown");
  countdowns.forEach((cd) => {
    const endTime = new Date(cd.dataset.time).getTime();
    const id = cd.dataset.id;

    if (!endTime || isNaN(endTime)) return;

    const interval = setInterval(() => {
      const now = new Date().getTime();
      const distance = endTime - now;

      if (distance <= 0) {
        cd.innerText = "Waktu Habis";
        document.getElementById("action-" + id).style.display = "block";
        clearInterval(interval);
      } else {
        const h = Math.floor((distance / (1000 * 60 * 60)) % 24);
        const m = Math.floor((distance / (1000 * 60)) % 60);
        const s = Math.floor((distance / 1000) % 60);
        cd.innerText = `${h}j ${m}m ${s}d`;
      }
    }, 1000);
  });
}
startCountdown();
