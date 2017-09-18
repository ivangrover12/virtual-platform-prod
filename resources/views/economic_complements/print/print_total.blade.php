@extends('globalprint.print')
@section('subtitle')
@if($economic_complement->old_eco_com)
	<center><b>(RECALIFICACION)</b></center>
	@endif
@endsection
@section('content')
<style type="text/css">
    .number{
      text-align: right;
    }
</style>
   <div id="project">

    	<div class="title2">
    		<strong>
    			Tramite N°: {!! $economic_complement->code !!}
    		</strong>
    	</div> 
			  {{--Información beneficiario--}}
  @if($economic_complement->economic_complement_modality->economic_complement_type->id > 1)
  <table class="table" style="width:100%;">
  	<tr>
  		<td colspan="4" class="grand service">
  			INFORMACIÓN DEL AFILIADO 
  			@if($economic_complement->economic_complement_modality->economic_complement_type->id > 1)
  			- CAUSAHABIENTE
  			@endif
  		</td>
  	</tr>
  	<tr>
  		<td>NOMBRE:</td><td nowrap>{!! $affiliate->getFullNamePrintTotal() !!}</td>
  		<td>C.I.:</td><td nowrap>  {!! $affiliate->identity_card !!} {!! $affiliate->city_identity_card->first_shortened ?? '' !!}</td>
  	</tr>
  	<tr>
  		<td>FECHA NACIMIENTO:</td><td> {!! $affiliate->getShortBirthDate() !!}</td><td>EDAD:</td><td>{!! $affiliate->getHowOld() !!}</td>
  	</tr>
  </table>
  @endif
  {{--Información derechohabiente--}}
  <table class="table" style="width:100%;">
  	<tr>
  		<td colspan="4" class="grand service">
  			INFORMACIÓN DEL BENECIFIARIO
  			@if($eco_com_applicant->economic_complement->economic_complement_modality->economic_complement_type->id > 1)
  			- DERECHOHABIENTE
  			@endif
  		</td>
  	</tr>
  	<tr>
  		<td>NOMBRE:</td><td nowrap>{!! $eco_com_applicant->getFullName() !!}</td>
  		<td>C.I.:</td><td nowrap>{!! $eco_com_applicant->identity_card !!} {{$eco_com_applicant->city_identity_card->first_shortened ?? ''}}
  		</td>
  	</tr>
  	<tr>
  		<td>FECHA NACIMIENTO:</td><td> {!! $eco_com_applicant->getShortBirthDate() !!}</td><td>EDAD:</td><td>{!! $eco_com_applicant->getHowOld() !!}</td>
  	</tr>
  	<tr>
  		<td>TELÉFONO:</td>
  		<td>
  			@foreach(explode(',',$eco_com_applicant->phone_number) as $phone)
  			{!! $phone !!}<br/>
  			@endforeach
  		</td>
  		<td>CELULAR:</td>
  		<td>
  			@foreach(explode(',',$eco_com_applicant->cell_phone_number) as $phone)
  			{!! $phone !!}<br/>
  			@endforeach
  		</td>
  	</tr>
  </table>

  {{--Información apoderado--}}  
@if($economic_complement->has_legal_guardian)
    <table>
      <tr>
        <td colspan="4" class="grand service">INFORMACIÓN DEL APODERADO</td>
      </tr>
      <tr>
        <td>NOMBRE:</td><td nowrap>{!! $economic_complement_legal_guardian->getFullName() !!}</td><td>C.I.:</td><td nowrap>{!! $economic_complement_legal_guardian->identity_card !!} {!! $economic_complement_legal_guardian->city_identity_card->first_shortened ?? '' !!}</td>
      </tr>
    </table>
@endif

{{--Información del trámite--}}
<table>
  <tr>
    <td colspan="4" class="grand service">INFORMACIÓN DEL TRÁMITE</td>
  </tr>
  <tr>
    <td>TIPO DE TRÁMITE: </td><td>{{ $economic_complement->economic_complement_modality->economic_complement_type->name ?? '' }}</td>
    <td>MODALIDAD: </td><td>{{ $economic_complement->economic_complement_modality->shortened ?? '' }}</td>
  </tr>
  <tr>
    <td>GRADO:</td><td>{!! $economic_complement->degree->shortened ?? '' !!}</td>
    <td>GESTIÓN:</td><td> {!! $economic_complement->getYear() !!}</td>
  </tr>
  <tr>
  	<td>CATEGORÍA:</td><td>{!! $economic_complement->category->getPercentage() !!}</td>
    <td>SEMESTRE:</td><td>{!! $economic_complement->semester !!}</td>
  </tr>
  <tr>
    <td>REGIONAL:</td>  	
    <td>{!! $economic_complement->city->name !!}</td>  	
    <td>ENTE GESTOR:</td>
    <td>{!! $affiliate->pension_entity->name ?? '' !!}</td>
  </tr>
  <tr>
    <td>TIPO DE RECEPCION: </td>  	
    <td>{!! $economic_complement->reception_type !!}</td>  	
    <td>FECHA DE RECEPCION:</td>
    <td>{!! $economic_complement->reception_date !!}</td>
  </tr>
</table>
<table>
  <tr>
    <td colspan="3" class="grand service" ><strong>CÁLCULO DEL TOTAL PAGADO</strong></td>
  </tr>
  @if( $eco_tot_frac)
  <tr>
    <td>TOTAL FRACCIONES (SA, COMP, SOL)</td><td class="number"><b>{{$eco_tot_frac}}</b></td><td></td>
  </tr>
  @endif
  <tr>
    <td colspan="3"></td>
  </tr>
  <tr>
    <td class="grand service" rowspan="2"><b>CONCEPTO</b></td>
    <td class="grand service" colspan="2"><b style="text-align: center">MONTO CALCULADO</b></td>
  </tr>
  <tr>
    <td class="grand service"><b>A FAVOR</b></td><td class="grand service"><b>DESCUENTO</b></td>
  </tr>
  <tr>
    <td><b>BOLETA TOTAL</b></td><td class="number"><b>{{$total_rent}}</b></td><td></td>
  </tr>
  <tr>
    <td>NETO</td><td class="number">{{$total_rent_calc}}</td><td></td>
  </tr>
  <tr>
    <td>REFERENTE SALARIAL</td><td class="number">{{$salary_reference}}</td><td></td>
  </tr>
  <tr>
    <td>ANTIGÜEDAD</td><td class="number">{{$seniority}}</td><td></td>
  </tr>
  <tr>
    <td>SALARIO COTIZABLE</td><td class="number">{{$salary_quotable}}</td><td></td>
  </tr>
  <tr>
    <td>DIFERENCIA</td><td class="number">{{$difference}}</td><td></td>
  </tr>
  <tr>
    <td>TOTAL SEMESTRE</td><td class="number">{{$total_amount_semester}}</td><td></td>
  </tr>
  <tr>
    <td>FACTOR DE COMPLEMENTACION</td><td class="number">{{ $factor_complement }} %</td><td></td>
  </tr>
  @if($economic_complement->amount_loan)
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MORA POR PRÉSTAMOS</td><td></td><td class="number" >{{$economic_complement->amount_loan}}</td>
  </tr>
  @endif
  @if($economic_complement->amount_accounting)
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MONTO POR CONTABILIDAD</td><td></td><td class="number" >{{$economic_complement->amount_accounting}}</td>
  </tr>
  @endif
  @if($economic_complement->amount_replacement)
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MONTO POR REPOSICION</td><td></td><td class="number" >{{$economic_complement->amount_replacement}}</td>
  </tr>
  @endif
  <tr>
  <td class="grand service"><b>TOTAL PAGADO COMP. ECO.</b></td><td class="number"><b>{{$total}}</b></td><td></td>
  </tr>

</table>
	@if($economic_complement->old_eco_com)
		<h1><strong>COMPLEMENTO ECONOMICO ANTERIOR</strong></h1>
		<br>
		<table>
		  <tr>
		    <td colspan="4" class="grand service">INFORMACIÓN DEL TRÁMITE</td>
		  </tr>
		  <tr>
		    <td>TIPO DE TRÁMITE: </td><td>{{ $old_eco_com_modality_name }}</td>
		    <td>MODALIDAD: </td><td>{{ $old_eco_com_modality }}</td>
		  </tr>
		  <tr>
		    <td>GRADO:</td><td>{!! $old_eco_com_degree !!}</td>
		    <td>GESTIÓN:</td><td> {!! $old_eco_com_year!!}</td>
		  </tr>
		  <tr>
		  	<td>CATEGORÍA:</td><td>{!! $old_eco_com_category !!}</td>
		    <td>SEMESTRE:</td><td>{!! $old_eco_com->semester !!}</td>
		  </tr>
		  <tr>
		    <td>REGIONAL:</td>  	
		    <td>{!! $old_eco_com_city !!}</td>  	
		    <td>ENTE GESTOR:</td>
		    <td>{!! $affiliate->pension_entity->name ?? '' !!}</td>
		  </tr>
		  <tr>
		    <td>TIPO DE RECEPCION: </td>  	
		    <td>{!! $old_eco_com->reception_type !!}</td>  	
		    <td>FECHA DE RECEPCION:</td>
		    <td>{!! $old_eco_com->reception_date !!}</td>
		  </tr>
		</table>
		<table>
		  <tr>
		    <td colspan="3" class="grand service" ><strong>CÁLCULO DEL TOTAL PAGADO</strong></td>
		  </tr>
		  @if($old_eco_com_total_frac > 0 && $old_eco_com_total_frac)
		  <tr>
		    <td class="grand service" rowspan="2"><b>DETALLE</b></td>
		    <td class="grand service" colspan="2"><b style="text-align: center">FRACCIÓN CALCULADO</b></td>
		  </tr>
		  <tr>
		    <td class="grand service"><b>A FAVOR</b></td><td class="grand service"><b>DESCUENTO</b></td>
		  </tr>
		  <tr>
		    <td class="grand service"><b>TOTAL FRACCIONES (SA, COMP, SOL)</b></td><td class="number"><b>{{$old_eco_com_total_frac}}</b></td><td></td>
		  </tr>
		  <tr>
		    <td colspan="3"></td>
		  </tr>
		  @endif
		  <tr>
		    <td class="grand service" rowspan="2"><b>CONCEPTO</b></td>
		    <td class="grand service" colspan="2"><b style="text-align: center">MONTO CALCULADO</b></td>
		  </tr>
		  <tr>
		    <td class="grand service"><b>A FAVOR</b></td><td class="grand service"><b>DESCUENTO</b></td>
		  </tr>
		  <tr>
		    <td><b>BOLETA TOTAL</b></td><td class="number"><b>{{$old_eco_com->total_rent}}</b></td><td></td>
		  </tr>
		  <tr>
		    <td>NETO</td><td class="number">{{$old_eco_com->total_rent_calc}}</td><td></td>
		  </tr>
		  <tr>
		    <td>REFERENTE SALARIAL</td><td class="number">{{$old_eco_com->salary_reference}}</td><td></td>
		  </tr>
		  <tr>
		    <td>ANTIGÜEDAD</td><td class="number">{{$old_eco_com->seniority}}</td><td></td>
		  </tr>
		  <tr>
		    <td>SALARIO COTIZABLE</td><td class="number">{{$old_eco_com->salary_quotable}}</td><td></td>
		  </tr>
		  <tr>
		    <td>DIFERENCIA</td><td class="number">{{$old_eco_com->difference}}</td><td></td>
		  </tr>
		  <tr>
		    <td>TOTAL SEMESTRE</td><td class="number">{{$total_amount_semester}}</td><td></td>
		  </tr>
		  <tr>
		    <td>FACTOR DE COMPLEMENTACION</td><td class="number">{{ $old_eco_com->complementary_factor }} %</td><td></td>
		  </tr>
		  @if($old_eco_com->amount_loan)
		  <tr>
		    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MORA POR PRÉSTAMOS</td><td></td><td class="number" >{{$old_eco_com->amount_loan}}</td>
		  </tr>
		  @endif
		  @if($old_eco_com->amount_accounting)
		  <tr>
		    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MONTO POR CONTABILIDAD</td><td></td><td class="number" >{{$old_eco_com->amount_accounting}}</td>
		  </tr>
		  @endif
		  @if($old_eco_com->amount_replacement)
		  <tr>
		    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MONTO POR REPOSICION</td><td></td><td class="number" >{{$old_eco_com->amount_replacement}}</td>
		  </tr>
		  @endif
		  <tr>
		  <td class="grand service"><b>TOTAL PAGADO COMP. ECO.</b></td><td class="number"><b>{{$old_eco_com->total}}</b></td><td></td>
		  </tr>
		</table>
	@endif
	<table>
	<tr>
	<td colspan="3" class="grand service">NOTA</td>
	</tr>
	<tr>
	<td colspan="3"><b> </b>{!!$economic_complement->comment!!}</td>
	</tr>
	</table>
	<table>
	  <tr>
	    <th class="info" style="border: 0px;text-align:center;"><p>&nbsp;</p><br>-------------------------------------------</th>
	  </tr>
	  <tr>
	    <th class="info" style="border: 0px;text-align:center;"><b>Elaborado por {!! $user_1->first_name !!} {!! $user_1->last_name !!} <br> {!! $user_1->getAllRolesToString() !!}</b></th>        
	  </tr>
	</table>

</div>
@endsection