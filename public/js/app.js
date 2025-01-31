const path = window.location.pathname.split('/').pop();

function linkRows()
{
	const rows = document.querySelectorAll(".row");
	
	for (let i = 0; i < rows.length; i++) 
	{
		rows[i].addEventListener("click", () =>
		{
			window.location.href = `/flights/${i + 1}`;;
	  	});
	}
}

if (!path)
{
	linkRows();
}
