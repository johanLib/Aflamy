
# Aflamy - Movie Organizer Web App

Aflamy is a movie management web application that helps users systematically organize their movies into categorized lists. Whether you're watching, have completed, or plan to watch movies, Aflamy provides an intuitive and flexible interface to keep everything organized.

With Aflamy, you can:

- Track movies with statuses: **Watching, Completed, On-Hold, Dropped, To Watch**.
- Rate, search, and manage movies seamlessly.
- Enjoy a user-friendly and visually appealing experience.

---

## Table of Contents

- [Features](#features)
- [Screenshots](#screenshots)
- [Technologies Used](#technologies-used)
- [Setup Instructions](#setup-instructions)
- [How to Use](#how-to-use)
- [API Integration](#api-integration)
- [Contributing](#contributing)
- [License](#license)

---

## Features

- **User Authentication**: Sign in and Sign up securely using email and password.
- **Update Profile**: Customize your user profile.
- **Movie Management**:
  - Add movies to your personalized lists.
  - Remove a specific movie from a list.
  - Change the status of a movie (Watching, Completed, etc.).
  - Add movies to your **Favorites**.
- **Movie Visualization**:
  - View your movies through a unique and well-organized interface.
  - Rate movies on a scale of 1-10.
- **Movie Search**:
  - Search for movies quickly and intuitively.
  - Get detailed movie information via **IMDB API**.

---

## Screenshots

Here are a few snapshots of Aflamy:

![Homepage](screenshots/aflamy.png)

![index](screenshots/index.jpg)

![home](screenshots/home.jpg)

![completed](screenshots/completed.jpg)

![movies](screenshots/movies.jpg)

![features](screenshots/features.jpg)

---

## Technologies Used

- **Frontend**: HTML, SCSS, Vanilla JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **External API**: IMDB API for movie data

---

## Setup Instructions

Follow these steps to set up the Aflamy web application locally:

### Prerequisites

- **PHP**: Ensure PHP is installed on your system.
- **MySQL**: A working MySQL server.
- **Web Server**: Apache, Nginx, or any server of your choice (XAMPP, WAMP recommended).

### Steps

1. **Clone the Repository**

   ```bash
   git clone https://github.com/johanLib/Aflamy.git
   cd Aflamy
   ```

2. **Setup the Database**

   - Create a MySQL database (e.g., `aflamy_db`).
   - Import the provided `aflamy.sql` file into your database.

3. **Configure the Database Connection**

   - Open `config.php` or equivalent configuration file.
   - Update the database credentials:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'your_username');
     define('DB_PASS', 'your_password');
     define('DB_NAME', 'aflamy_db');
     ```

4. **Run the Application**

   - Start your web server and navigate to `http://localhost/Aflamy`.

---

## How to Use

1. **Sign Up / Sign In**

   - Create an account using your email and password.

2. **Manage Your Movies**

   - Add movies to your lists by searching via the search bar.
   - Update movie statuses (e.g., Watching, Completed, etc.).
   - Rate your movies and add favorites.

3. **Search for Movies**

   - Use the search functionality to fetch movie details using IMDB API.

4. **Profile Management**

   - Update your profile anytime.

---

## API Integration

Aflamy uses the **IMDB API** to fetch real-time movie details.

- Ensure API access by setting up your IMDB API key in the configuration file.
- Example usage:
  ```javascript
  fetch(`https://api.imdbapi.com/?apikey=your_key&title=movie_name`)
  .then(response => response.json())
  .then(data => console.log(data));
  ```

---

## Contributing

Contributions are welcome!

If you wish to contribute:

1. Fork this repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Commit your changes (`git commit -m "Add new feature"`).
4. Push to the branch (`git push origin feature-branch`).
5. Create a Pull Request.

---

## License

This project is licensed under the [MIT License](LICENSE).

---

## Author

Developed by **[JohanLib](https://github.com/johanLib)**.

---

> "Aflamy: Simplify how you organize, track, and enjoy your favorite movies!"
