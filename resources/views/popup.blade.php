
  <style>
    .popup {
      position: fixed;
      top: 30px; 
      left: 50%;
      transform: translateX(-50%);
      width: 50%; 
      max-width: 400px; 
      aspect-ratio: 3 / 1; 
      background-color: #d0e7ff; 
      color: #004080; 
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      font-size: 1.2rem;
      font-weight: bold;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.5s ease;
      z-index: 1000;
      padding: 10px;
      text-align: center;
    }

    .popup.show {
      opacity: 1;
      pointer-events: auto;
    }
  </style>
  <div id="popup" class="popup"></div>

  <script>
    function showPopup(message) {
      const popup = document.getElementById("popup");
      popup.textContent = message;
      popup.classList.add("show");

      setTimeout(() => {
        popup.classList.remove("show");
      }, 3000);
    }
    window.onload = () => {
      showPopup(message);
    };
  </script>

