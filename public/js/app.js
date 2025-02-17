const path = window.location.pathname.split('/').pop();

function linkRows()
{
	const rows = document.querySelectorAll(".row");
	
	for (let i = 0; i < rows.length; i++) 
	{
		rows[i].addEventListener("click", () =>
		{
			window.location.href = `/flights/${rows[i].id}`;
	  	});
	}
}

function filterTable()
{
	const input = document.getElementById("input");

	if (!input)
		return ;
	input.addEventListener("input", function ()
	{
		const filter = this.value.toLowerCase();
		const rows = document.getElementById("table").querySelectorAll(".getRows");
	
		for (let i = 0; i < rows.length; i++) 
		{
			rows[i].style.display = "";
			if (!rows[i].innerHTML.toLowerCase().includes(filter))
			{
				rows[i].style.display = "none";
			}
		}
	});
}

if (!path)
{
	filterTable();
	linkRows();
}
if (path === "bookings")
{
	filterTable();
}
