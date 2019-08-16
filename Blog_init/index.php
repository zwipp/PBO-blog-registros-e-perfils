<?php

try {
	require 'req/conexao.php';
	$select = $conexao->prepare("SELECT * FROM posts ORDER BY id DESC"); // ira pegar o id e ordenar eles de forma decrescente
	$select -> execute();

	$posts = $select->fetchAll(PDO::FETCH_ASSOC);

	$ultimosPost = array_slice($posts, 0, 3);

	$conexao = null;
} catch(PDOException $erro) {
	echo $erro->getMessage();
}

		include 'layouts/head.php';
		include 'layouts/header.php';
	?>

<!--================ Hero sm Banner start =================-->
<section class="mb-30px">
	<div class="container">
		<div class="hero-banner hero-banner--sm">
			<div class="hero-banner__content">
				<h1>Bem vindo ao Blog</h1>
			</div>
		</div>
	</div>
</section>
<!--================ Hero sm Banner end =================-->

<!--================ Start Blog Post Area =================-->
<section class="blog-post-area section-margin">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="row">
					<?php foreach($posts as $post) : ?>
					<div class="col-md-6">
						<div class="single-recent-blog-post card-view">
							<div class="thumb">
								<img
									class="card-img rounded-0"
									src="<?= $post["url_img"] ?>"
									alt=""
								/>
								<ul class="thumb-info">
									<li>
										<a href="#"><?= $post['categoria']; ?></a>
									</li>
									<li>
										<a href="#"><i class="fas fa-calendar"></i> <?= date('d/m/Y', strtotime($post["data"])) ?> </a>
									</li>
								</ul>
							</div>
							<div class="details mt-20">
								<a href="blog-single.html">
									<h3>
										<?= $post['titulo']; ?>
									</h3>
								</a>
								<p>
									<?= substr($post['texto'], 0, 20) . '...'; ?>
								</p>
								<a class="button" href="detalhes.php?id=<?= $post['id'] ?>"
									>Ler Mais <i class="ti-arrow-right"></i
								></a>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>

			<!-- Start Blog Post Siddebar -->
			<div class="col-lg-4 sidebar-widgets">
				<div class="widget-wrap">
					<div class="single-sidebar-widget popular-post-widget">
						<h4 class="single-sidebar-widget__title">Últimos Posts</h4>
						<div class="popular-post-list">
							<?php foreach($ultimosPost as $post) : ?>
							<div class="single-post-list">
								<div class="thumb">
									<img
										class="card-img rounded-0"
										src="<?= $post['url_img'] ?>"
										alt=""
									/>
									<ul class="thumb-info">
										<li><a href="#"><?= $post['categoria'] ?></a></li>
										<li><a href="#"><?= date('d/m/Y', strtotime($post["data"])) ?></a></li>
									</ul>
								</div>
								<div class="details mt-20">
									<a href="blog-single.html">
										<h6>
										<?= $post['titulo'] ?>
										</h6>
									</a>
								</div>
							<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Blog Post Siddebar -->
	</div>
</section>

<?php include 'layouts/footer.php' ?>
