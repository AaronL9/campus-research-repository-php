<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>

<main class="repository-page">
  <a href="/repository">
    <svg
      width="34px"
      height="34px"
      viewBox="0 0 1024 1024"
      xmlns="http://www.w3.org/2000/svg"
      fill="#000000"
    >
      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
      <g
        id="SVGRepo_tracerCarrier"
        stroke-linecap="round"
        stroke-linejoin="round"
      ></g>
      <g id="SVGRepo_iconCarrier">
        <path
          fill="#000000"
          d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"
        ></path>
        <path
          fill="#000000"
          d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"
        ></path>
      </g>
    </svg>
  </a>

  <section>
    <h1><?= $research->title ?></h1>
    <ul>
      <li>
        <p class="label">Author:</p>
        <p><?= $research->author ?></p>
      </li>
      <li>
        <p class="label">Department:</p>
        <p><?= $research->department ?></p>
      </li>
      <li>
        <p class="label">Published Year:</p>
        <p><?= $research->published_year ?></p>
      </li>
      <li>
        <p class="label">Abstract:</p>
        <p><?= $research->description ?></p>
      </li>
    </ul>
    <!-- <iframe src="https://www.cs.sfu.ca/~ashriram/Courses/CS295/assets/books/CSAPP_2016.pdf" width="80%" height="800px" frameborder="0"></iframe> -->
  </section>
</main>

<?= loadPartial('footer') ?>