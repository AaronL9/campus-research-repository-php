<?= loadPartial('head') ?>
<?= loadPartial('navbar') ?>

<main class="repository">
  <form action="">
    <div class="search">
      <button type="submit" class="search-btn">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M14.75 14.75L11.4875 11.4875M13.25 7.25C13.25 10.5637 10.5637 13.25 7.25 13.25C3.93629 13.25 1.25 10.5637 1.25 7.25C1.25 3.93629 3.93629 1.25 7.25 1.25C10.5637 1.25 13.25 3.93629 13.25 7.25Z" stroke="#A9A9A9" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
      <input id="current-page" type="number" name="page" value="1">
      <input id="current-sort" type="text" name="sort" value="<?= $sort === 'DESC' ? 'descending' : 'ascending' ?>">
      <input class="search__field" placeholder="Search..." name="search" type="text" value="<?= $search ?? '' ?>">
    </div>
  </form>

  <section class="repository-container">
    <div class="repository-container__top">
      <p>Result: <?= $count->total ?></p>
      <form class="sort-wrapper" action="/repository" method="GET">
        <input id="current-page" type="number" name="page" value="<?= $page ?>">
        <label for="sort">Sort by</label>
        <select class="sort-field" name="sort" id="sort" onchange="this.form.submit()">
          <option <?= $sort === "DESC" ? "selected" : "" ?>  value="descending">Date: Descending</option>
          <option <?= $sort === "ASC" ? "selected" : "" ?>  value="ascending">Date: Ascending</option>
        </select>
      </form>
    </div>

    <div class="repository-container__main">
      <?php foreach ($research as $data) : ?>
        <div class="repository-card">
          <h2 class="repository-card__title"><?= $data->title ?></h2>
          <p class="repository-card__author">Author: <?= $data->author ?></p>
          <p class="repository-card__date">Last Modified: <?= formatDate($data->created_at) ?></p>
          <p class="repository-card__description">
            <?= $data->description ?>
          </p>
          <a href="/repository/<?= $data->id ?>" class="repository-card__btn">View</a>
        </div>
        <div class="divider"></div>
      <?php endforeach ?>
    </div>

  </section>
  <!-- <form id="pagination-form" action="/repository" method="GET" class="pagination">
    <p>items per page: 10</p>
    <input id="page-label" type="number" name="page-label" disabled>
    <input id="page" type="number" name="page" >
    <div class="pagination-buttons">
      <button type="submit" id="decrement-btn"><</button>
      <button type="submit" id="increment-btn">></button>
    </div>
  </form> -->
  <div class="pagination">
    <p>items per page: 10</p>
    <p><?= $page ?></p>
      <?php if ($page === "1") : ?>
        <span class="disable">Prev</span>
      <?php else : ?>
        <a href="/repository?page=<?= $page - 1 ?>&sort=<?= $sort === "DESC" ? "descending" : "ascending" ?>">Prev</a>
      <?php endif; ?>

      <?php if ($page == $totalPages) : ?>
        <span class="disable">Next</span>
      <?php else : ?>
        <a href="/repository?page=<?= $page + 1 ?>&sort=<?= $sort === "DESC" ? "descending" : "ascending" ?>">Next</a>
      <?php endif; ?>
  </div>
</main>

<?= loadPartial('footer') ?>