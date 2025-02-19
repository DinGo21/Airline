const path = window.location.pathname.split('/').pop();

function userShowTables()
{
	const shows = document.querySelectorAll("#show-flights");
	const popups = document.querySelectorAll("#popup-flights");

	for	(let i = 0; i < shows.length; i++)
	{
		shows[i].addEventListener("click", () => popups[i].classList.remove("d-none"));
		popups[i].addEventListener("click", () => popups[i].classList.add("d-none"));
	}
}

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
if (path === "users")
{
	userShowTables();
}
