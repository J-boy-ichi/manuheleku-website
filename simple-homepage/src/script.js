document.addEventListener('DOMContentLoaded', function() {
    const header = document.createElement('header');
    header.innerHTML = '<h1>Welcome to My Simple Homepage</h1>';
    document.body.appendChild(header);

    const main = document.createElement('main');
    main.innerHTML = '<p>This is a simple homepage created as a sample project.</p>';
    document.body.appendChild(main);

    const footer = document.createElement('footer');
    footer.innerHTML = '<p>&copy; 2023 My Simple Homepage</p>';
    document.body.appendChild(footer);

    // Example of adding an event listener
    const button = document.createElement('button');
    button.textContent = 'Click Me!';
    document.body.appendChild(button);

    button.addEventListener('click', function() {
        alert('Button was clicked!');
    });
});