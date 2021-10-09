      <div class="form-row">
             <div class="form-group col-md-4">
               <label for="nome"> Nome: <span class="text-danger">*</span> </label>
               <input type="text" class="form-control" name="nome" id="nome" value="<?php echo old('name', esc($sistema->nome));?>">
             </div>
             <div class="form-group col-md-3">
               <label for="cnpj"> CNPJ: <span class="text-danger">*</span> </label>
               <input type="text" class="form-control cnpj" name="cnpj" value="<?php echo old('cnpj', esc($sistema->cnpj));?>">
             </div>
             <div class="form-group col-md-2">
               <label for="telefone">Telefone: <span class="text-danger">*</span> </label>
               <input type="text" class="form-control " name="telefone" value="<?php echo old('telefone', esc($sistema->telefone));?>">
             </div>

             <div class="form-group col-md-3">
               <label for="email">Email: <span class="text-danger">*</span> </label>
               <input type="email" class="form-control"name="email" id="email" value="<?php echo old('email', esc($sistema->email));?>">
             </div>
             <div class="form-group col-md-3">
               <label for="veiculo">CEP</label>
               <input type="text" class="form-control " id="cep"
               name="cep" value="<?php echo old('cep', esc($sistema->cep));?>">
             </div>

             <div class="form-group col-md-3">
               <label for="numero">Número: <span class="text-danger">*</span></label>
               <input type="text" class="form-control numero" id="numero"
               name="numero" value="<?php echo old('numero', esc($sistema->numero));?>">
             </div>

             <div class="form-group col-md-6">
               <label for="cidade">Cidade: <span class="text-danger">*</span></label>
               <input type="text" class="form-control" id="cidade"
               name="cidade" value="<?php echo old('cidade', esc($sistema->cidade));?>">

             </div>

             <div class="form-group col-md-6">
               <label for="numero">Estado: <span class="text-danger">*</span></label>
               <select class="form-control form-control " name="estado">
                	<option value="Acre">Acre</option>
                	<option value="Alagoas">Alagoas</option>
                	<option value="Amapá">Amapá</option>
                	<option value="Amazonas">Amazonas</option>
                	<option value="Bahia">Bahia</option>
                	<option value="Ceará">Ceará</option>
                	<option value="Distrito Federal">Distrito Federal</option>
                	<option value="Espírito Santo">Espírito Santo</option>
                	<option value="Goiás">Goiás</option>
                	<option value="Maranhão">Maranhão</option>
                	<option value="Mato Grosso">Mato Grosso</option>
                	<option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                	<option value="Minas Gerais">Minas Gerais</option>
                	<option value="Pará">Pará</option>
                	<option value="Paraíba">Paraíba</option>
                	<option value="Paraná">Paraná</option>
                	<option value="Pernambuco">Pernambuco</option>
                	<option value="Piauí">Piauí</option>
                	<option value="Rio de Janeiro">Rio de Janeiro</option>
                	<option value="Rio Grande do Norte">Rio Grande do Norte</option>
                	<option value="Rio Grande do Sul">Rio Grande do Sul</option>
                	<option value="Rondônia">Rondônia</option>
                	<option value="Roraima">Roraima</option>
                	<option value="Santa Catarina">Santa Catarina</option>
                	<option value="São Paulo">São Paulo</option>
                	<option value="Sergipe">Sergipe</option>
                	<option value="Tocantins">Tocantins</option>
                </select>
             </div>

             <div class="form-group col-md-3">
									<label for="ativo"> Ativo: <span class="text-danger">*</span> </label>
                  <select class="form-control form-control-ativo" name="ativo" required>
                     <?php if($sistema->id): ?>
                       <option value="1" <?php echo ($sistema->ativo ? 'selected' : ''); ?>>Sim</option>
                       <option value="0" <?php echo (!$sistema->ativo ? 'selected' : ''); ?>>Não</option>
                     <?php else : ?>
                       <option value="1" class="text-success">Sim</option>
                       <option value="0" selected="">Não</option>
                     <?php endif ?>
                 </select>
             </div>
             <div class="form-group col-md-12 mb-5">
               <label for="placa">Endereço</label>
               <input type="text" class="form-control " id="endereco"
               name="endereco" value="<?php echo old('endereco', esc($sistema->endereco));?>">
             </div>
           </div>
             <button type="submit" class="btn btn-primary mr-2 btn-smmt-"><i class=" mdi mdi-content-save btn-icon-prepend mr-1"></i>Salvar
             </button>
