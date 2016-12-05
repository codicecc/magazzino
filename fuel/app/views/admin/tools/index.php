<div class="container tools">

	<div class="row">
		<div class="col-md-12">
			<h2>Codici</h2>
		</div>
		<div class="col-md-3">
		<?php if(Auth::has_access('Controller_Admin_Codesource.sync')):?>
			<a href="/admin/codesource/sync"><button class="col-md-12 btn btn-info btn-lg" >Verifica<br />Code Source 
				<span id="verificacodici"><img src="<?php echo Asset::get_file("loading.gif","img");?>"></span>
				</button>
			</a>
		<?php endif;?>
		</div>
		<div class="col-md-3">
		<?php if(Auth::has_access('Controller_Admin_Codenew.sync')):?>
			<a href="/admin/codenew/sync"><button class="col-md-12 btn btn-info btn-lg" >Verifica<br />Code New 
				</button>
			</a>
		<?php endif;?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<h2>Ecommerce</h2>
		</div>
		<div class="col-md-3">
		<?php if(Auth::has_access(Request::active()->controller.'.mageCheck')):?>
			<a href="/admin/tools/mageCheck"><button class="col-md-12 btn btn-info btn-lg" >Verifica stato<br />sincronizzazione<br />Ecommerce</button></a>
		<?php endif;?>
		</div>
		<div class="col-md-3">
		<?php if(Auth::has_access(Request::active()->controller.'.mageAllChangeQty')):?>
			<a href="/admin/tools/mageAllChangeQty">
			<button  class=" col-md-12 btn btn-info btn-lg" >
			Sincronizza<br />
			Ecommerce</button>
			</a>
		<?php endif;?>
		</div>
		<div class="col-md-3">
		<?php if(Auth::has_access(Request::active()->controller.'.mageCheck_ecommerce_magazzino')):?>
			<a href="/admin/tools/mageCheck_ecommerce_magazzino/1"><button  class="col-md-12 btn btn-warning btn-lg" >
			<b>Confronto</b><br />
			In Ecommerce<br />
			No Magazzino</button></a>
		<?php endif;?>
		</div>
		<div class="col-md-3">
		<?php if(Auth::has_access(Request::active()->controller.'.mageCheck_ecommerce_magazzino')):?>
		<a href="/admin/tools/mageCheck_ecommerce_magazzino/2"><button  class="col-md-12 btn btn-warning btn-lg" >
			<b>Confronto</b><br />
			In Magazzino<br />
			No Ecommerce</button></a>
		<?php endif;?>
		</div>	
	</div>
</div>

