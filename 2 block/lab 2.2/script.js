function updateDisplay(value) {
  document.getElementById("display").value += value;
}

function clearDisplay() {
  document.getElementById("display").value = "";
}

document.querySelectorAll("[data-value]").forEach((button) => {
  button.addEventListener("click", () => {
    updateDisplay(button.dataset.value);
  });
});

function calculate() {
  const expression = document.getElementById("display").value.trim();
  if (!expression) {
    alert("Пожалуйста, введите выражение!");
    return;
  }
  fetch("calculate.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: "expression=" + encodeURIComponent(expression),
  })
    .then((response) => response.text())
    .then((result) => {
      document.getElementById("display").value = result;
      window.location.href = `?result=${encodeURIComponent(result)}`;
    })
    .catch((error) => console.error("Ошибка:", error));
}

window.onload = function () {
  const urlParams = new URLSearchParams(window.location.search);
  const result = urlParams.get("result");
  if (result) {
    document.getElementById("display").value = decodeURIComponent(result);
  }
};
