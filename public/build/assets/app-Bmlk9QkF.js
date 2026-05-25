document.addEventListener("DOMContentLoaded",()=>{console.log("JS plano cargado correctamente");const n=document.getElementById("openModal"),e=document.getElementById("eventModal"),d=document.getElementById("closeModal"),t=document.getElementById("eventForm"),o=document.getElementById("eventsTableBody");n&&e&&n.addEventListener("click",()=>{e.style.display="block"}),d&&e&&d.addEventListener("click",()=>{e.style.display="none"}),t&&o&&t.addEventListener("submit",c=>{c.preventDefault();const a=document.getElementById("eventName").value,m=document.getElementById("guestName").value,s=document.getElementById("giftName").value,l=document.createElement("tr");l.innerHTML=`
                <td>${a}</td>
                <td>${m}</td>
                <td>${s}</td>
            `,o.appendChild(l),t.reset(),e.style.display="none"})});
