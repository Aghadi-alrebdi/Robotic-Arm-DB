function updateValue(i) {
  document.getElementById(`value${i}`).textContent = document.getElementById(`motor${i}`).value;
}

function resetValues() {
  for (let i = 1; i <= 6; i++) {
    document.getElementById(`motor${i}`).value = 90;
    updateValue(i);
  }
}

function savePose() {
  const formData = new URLSearchParams();
  for (let i = 1; i <= 6; i++) {
    formData.append(`servo${i}`, document.getElementById(`motor${i}`).value);
  }

  fetch('save_pose.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: formData.toString()
  })
  .then(res => res.text())
  .then(alert)
  .then(() => location.reload());
}


function runPose() {
  const data = {
    servo1: parseFloat(document.getElementById('motor1').value),
    servo2: parseFloat(document.getElementById('motor2').value),
    servo3: parseFloat(document.getElementById('motor3').value),
    servo4: parseFloat(document.getElementById('motor4').value),
    servo5: parseFloat(document.getElementById('motor5').value),
    servo6: parseFloat(document.getElementById('motor6').value)
  };

  fetch('run_pose.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  })
  .then(res => res.text())
  .then(msg => alert(msg))
  .catch(err => alert("Error: " + err));
}


function loadPose(s1, s2, s3, s4, s5, s6) {
  const values = [s1, s2, s3, s4, s5, s6];
  for (let i = 1; i <= 6; i++) {
    document.getElementById(`motor${i}`).value = values[i-1];
    updateValue(i);
  }
}

function removePose(id) {
  if (!confirm("Are you sure you want to delete this pose?")) return;

  fetch('remove_pose.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: `id=${id}`
  })
  .then(res => res.text())
  .then(alert)
  .then(() => location.reload());
}

window.onload = () => {
  fetch('get_pose.php')  
    .then(res => res.json())
    .then(data => {
      const tbody = document.querySelector('#poseTable tbody');
      tbody.innerHTML = ''; 
      data.forEach(row => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${row.id}</td>
          <td>${row.servo1}</td>
          <td>${row.servo2}</td>
          <td>${row.servo3}</td>
          <td>${row.servo4}</td>
          <td>${row.servo5}</td>
          <td>${row.servo6}</td>
          <td>
            <button onclick="loadPose(${row.servo1}, ${row.servo2}, ${row.servo3}, ${row.servo4}, ${row.servo5}, ${row.servo6})">Load</button>
            <button onclick="removePose(${row.id})">Remove</button>
          </td>`;
        tbody.appendChild(tr);
      });
    });
}
