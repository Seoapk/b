var pressTimer;
var rows = document.querySelectorAll("tr");

// Function to handle long click event
function longClick() {
  toggleDiv();
}

// Function to start timer on touch start
function startPress() {
  pressTimer = setTimeout(longClick, 600); // Adjust time threshold as needed (in milliseconds)
}

// Function to clear timer on touch end or touch cancel
function endPress() {
  clearTimeout(pressTimer);
}

// Add event listeners for touch start and touch end/cancel to each row
rows.forEach(function(row) {
  row.addEventListener("touchstart", startPress);
  row.addEventListener("touchend", endPress);
  row.addEventListener("touchcancel", endPress);
});

//1-SEARCH BY: ID, name, or amount
function filterTable() {
    const input = document.querySelector('.header input'); // Get the input element for filtering
    const filter = input.value.toUpperCase(); // Convert input to uppercase for case-insensitive matching
    const table = document.getElementById('sampleTable');
    const rows = table.getElementsByTagName('tr');
    // Loop through all table rows and hide those that do not match the filter
    for (let i = 2; i < rows.length ; i++) { // Start from index 1 to skip the header row and end before the footer row
        const row = rows[i];
        const cells = row.getElementsByTagName('td');
        let shouldDisplay = false;
        // Check if any cell in the row matches the filter
        for (let j = 0; j < cells.length; j++) {
            const cell = cells[j];
            const textValue = cell.textContent || cell.innerText; // Get the text content of the cell

            // If the text content contains the filter, set shouldDisplay to true and break the loop
            if (textValue.toUpperCase().indexOf(filter) > -1) {
                shouldDisplay = true;
                break;
            }
        }

        // Toggle row display based on shouldDisplay value
        row.style.display = shouldDisplay ? '' : 'none';
    }
}

//3 -SORT Event listener for input change to trigger filtering
document.querySelector('.header input').addEventListener('input', filterTable);

var sortOrder = 'asc'; // Initialize sort order

function sortTable(columnIndex) {
    var table, tbody, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("sampleTable");
    tbody = table.getElementsByTagName("tbody")[0];
    switching = true;

    while (switching) {
        switching = false;
        rows = tbody.rows;

        for (i = 0; i < rows.length - 1; i++) {
            shouldSwitch = false;

            // Check if the current column index is for the "Amount" or "ID" columns
            if (columnIndex === 0 || columnIndex === 2) {
                x = parseFloat(rows[i].getElementsByTagName("td")[columnIndex].innerText);
                y = parseFloat(rows[i + 1].getElementsByTagName("td")[columnIndex].innerText);
            } else {
            // For other columns, use regular string comparison
                x = rows[i].getElementsByTagName("td")[columnIndex].innerText.toLowerCase();
                y = rows[i + 1].getElementsByTagName("td")[columnIndex].innerText.toLowerCase();
            }

            if (sortOrder === 'asc') {
                if (x > y) {
                    shouldSwitch = true;
                    break;
                }
            } else {
                if (x < y) {
                    shouldSwitch = true;
                    break;
                }
            }
        }

        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }

    // Toggle sort order
    sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
}


//4 - HIDDEN DIV
function toggleDiv() {
  var div = document.getElementById("hiddenDiv");
  if (div.style.display === "none") {
    div.style.display = "block";
  } else {
    div.style.display = "none";
  }
}

function closeOnClickOutside(event) {
  if (event.target === event.currentTarget) {
    toggleDiv();
  }
}


function open_submit() {
	//OPEN
  var form = document.getElementById("H0");
  form.action = "action.php?act=open";
  form.submit();

}
function edit_submit() {
	//EDIT
  var form = document.getElementById("H0");
  form.action = "action.php?act=edit";
  form.submit();
}
function delete_submit() {
	//DELETE
   var form = document.getElementById("H0");
  form.action = "action.php?act=delete";
  form.submit(); 
}	

function item_submit() {
	//ADD ITEM
   var form = document.getElementById("ADD0");
  form.action = "action.php?act=additem";
  form.submit(); 
}

//4 - HIDDEN FORM FOR NEW CLIENT
function ashowHiddenForm() {
  // Show the transparent overlay and the hidden form
  document.getElementById("aoverlay").style.display = "block";
  document.getElementById("ahiddenForm").style.display = "block";
}

function ahideHiddenForm() {
  // Hide the transparent overlay and the hidden form
  document.getElementById("aoverlay").style.display = "none";
  document.getElementById("ahiddenForm").style.display = "none";
}

//4 - HIDDEN FORM FOR EDIT CLIENT
function bshowHiddenForm() {
  // Show the transparent overlay and the hidden form
  document.getElementById("boverlay").style.display = "block";
  document.getElementById("bhiddenForm").style.display = "block";
}

function bhideHiddenForm() {
  // Hide the transparent overlay and the hidden form
  document.getElementById("boverlay").style.display = "none";
  document.getElementById("bhiddenForm").style.display = "none";
}


