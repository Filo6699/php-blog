<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create a post</title>
  <style>
    .errors {
      position: fixed;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);

      padding: 20px;
      width: fit-content;
      background-color: tomato;
      
      z-index: 1000;
      display: flex;
      flex-direction: column;
    }

    .errors ul {
      padding: 0;
    }
  </style>
</head>
<body>
  <br>
  <img src="https://t3.ftcdn.net/jpg/02/36/99/22/360_F_236992283_sNOxCVQeFLd5pdqaKGh8DRGMZy7P4XKm.jpg" alt="cat image">
  <form method="post" action="">
    <label>tiltle</label>
    <input
      type="text"
      minlength="2"
      maxlength="64"
      name="title"
      required
    >
    <br>
    <label>description</label>
    <textarea
      type="text"
      minlength="2"
      maxlength="1024"
      name="description"
      required
    ></textarea>
    <button type="submit">Create a post</button>
  </form>
</body>
</html>