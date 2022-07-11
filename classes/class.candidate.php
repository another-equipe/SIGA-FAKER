<?php

class Candidate{
    public $nome;
    public $c_status;
    public $c_vaga;
    public $c_recrutador;
    public $c_recrutador_nome;
    public $c_recrutador_telefone;
    public $c_linkedin;
    public $c_fonte;
    public $c_email;
    public $c_telefone;
    public $c_tipo_de_documento;
    public $c_cpf;
    public $c_cnpj;
    public $c_razao;
    public $c_cep;
    public $c_logradouro;
    public $c_numero;
    public $c_complemento;
    public $c_bairro;
    public $c_cidade;
    public $c_estado;
    public $c_disponibilidade_tempo;
    public $c_disponibilidade_inicio;
    public $c_comissionamento;
    public $c_ensino_medio;
    public $c_atendimento_ao_cliente;
    public $c_possui_cnpj;
    public $c_cnh;
    public $c_ja_se_candidatou;
    public $c_curso_superior;
    public $c_mba;
    public $c_varejo;
    public $c_vendas;
    public $c_gerenciamento;
    public $c_dez_colaboradores;
    public $c_office;
    public $c_seguir_processos;
    public $c_ajudar_pessoas;
    public $c_proposito;
    public $c_organizado;
    public $c_multiplos_clientes;
    public $c_metrificar;
    public $c_selecao;
    public $c_treinamento;
    public $c_decisoes;
    public $c_resolver;
    public $c_experiencia_gestao;
    public $c_comunicacao;
    public $c_comunicacao_grupo;
    public $c_metas;
    public $c_emocional;
    public $c_lideranca;
    public $c_proatividade;
    public $c_feedback;
    public $c_avaliar;
    public $c_criatividade;
    public $c_resiliencia;
    public $c_comercial;
    public $c_aprender;
    public $c_colaborar;
    public $c_persistencia;
    public $c_vendedor;
    public $c_proprio_negocio;
    public $c_media;
    public $c_objetivo_de_ganhos;
    public $c_sobre_voce;
    public $c_signer_key;
    public $c_contratos_enviados;
    public $c_contrato_tipo;
    public $c_contrato_document_key;
    public $c_contrato_sign_key;
    public $c_contrato_status;
    public $c_contrato_data_do_envio;
    public $c_contrato_data_da_assinatura;
    public $e_diretor_nome;
    public $e_diretor_email;
    public $e_lider_nome;
    public $e_lider_email;
    public $e_gerente_nome;
    public $e_gerente_email;
    public $e_supervisor_nome;
    public $e_supervisor_email;

    public function __construct($data){
        $this->nome = $data["nome"];
        $this->c_status = $data["c_status"];
        $this->c_vaga = $data["c_vaga"];
        $this->c_recrutador = $data["c_recrutador"];
        $this->c_recrutador_nome = $data["c_recrutador_nome"];
        $this->c_recrutador_telefone = $data["c_recrutador_telefone"];
        $this->c_linkedin = $data["c_linkedin"];
        $this->c_fonte = $data["c_fonte"];
        $this->c_email = $data["c_email"];
        $this->c_telefone = $data["c_telefone"];
        $this->c_tipo_de_documento = $data["c_tipo_de_documento"];
        $this->c_cpf = $data["c_cpf"];
        $this->c_cnpj = $data["c_cnpj"];
        $this->c_razao = $data["c_razao"];
        $this->c_cep = $data["c_cep"];
        $this->c_logradouro = $data["c_logradouro"];
        $this->c_numero = $data["c_numero"];
        $this->c_complemento = $data["c_complemento"];
        $this->c_bairro = $data["c_bairro"];
        $this->c_cidade = $data["c_cidade"];
        $this->c_estado = $data["c_estado"];
        $this->c_disponibilidade_tempo = $data["c_disponibilidade_tempo"];
        $this->c_disponibilidade_inicio = $data["c_disponibilidade_inicio"];
        $this->c_comissionamento = $data["c_comissionamento"];
        $this->c_ensino_medio = $data["c_ensino_medio"];
        $this->c_atendimento_ao_cliente = $data["c_atendimento_ao_cliente"];
        $this->c_possui_cnpj = $data["c_possui_cnpj"];
        $this->c_cnh = $data["c_cnh"];
        $this->c_ja_se_candidatou = $data["c_ja_se_candidatou"];
        $this->c_curso_superior = $data["c_curso_superior"];
        $this->c_mba = $data["c_mba"];
        $this->c_varejo = $data["c_varejo"];
        $this->c_vendas = $data["c_vendas"];
        $this->c_gerenciamento = $data["c_gerenciamento"];
        $this->c_dez_colaboradores = $data["c_dez_colaboradores"];
        $this->c_office = $data["c_office"];
        $this->c_seguir_processos = $data["c_seguir_processos"];
        $this->c_ajudar_pessoas = $data["c_ajudar_pessoas"];
        $this->c_proposito = $data["c_proposito"];
        $this->c_organizado = $data["c_organizado"];
        $this->c_multiplos_clientes = $data["c_multiplos_clientes"];
        $this->c_metrificar = $data["c_metrificar"];
        $this->c_selecao = $data["c_selecao"];
        $this->c_treinamento = $data["c_treinamento"];
        $this->c_decisoes = $data["c_decisoes"];
        $this->c_resolver = $data["c_resolver"];
        $this->c_experiencia_gestao = $data["c_experiencia_gestao"];
        $this->c_comunicacao = $data["c_comunicacao"];
        $this->c_comunicacao_grupo = $data["c_comunicacao_grupo"];
        $this->c_metas = $data["c_metas"];
        $this->c_emocional = $data["c_emocional"];
        $this->c_lideranca = $data["c_lideranca"];
        $this->c_proatividade = $data["c_proatividade"];
        $this->c_feedback = $data["c_feedback"];
        $this->c_avaliar = $data["c_avaliar"];
        $this->c_criatividade = $data["c_criatividade"];
        $this->c_resiliencia = $data["c_resiliencia"];
        $this->c_comercial = $data["c_comercial"];
        $this->c_aprender = $data["c_aprender"];
        $this->c_colaborar = $data["c_colaborar"];
        $this->c_persistencia = $data["c_persistencia"];
        $this->c_vendedor = $data["c_vendedor"];
        $this->c_proprio_negocio = $data["c_proprio_negocio"];
        $this->c_media = $data["c_media"];
        $this->c_objetivo_de_ganhos = $data["c_objetivo_de_ganhos"];
        $this->c_sobre_voce = $data["c_sobre_voce"];
        $this->c_signer_key = $data["c_signer_key"];
        $this->c_contratos_enviados = $data["c_contratos_enviados"];
        $this->c_contrato_tipo = $data["c_contrato_tipo"];
        $this->c_contrato_document_key = $data["c_contrato_document_key"];
        $this->c_contrato_sign_key = $data["c_contrato_sign_key"];
        $this->c_contrato_status = $data["c_contrato_status"];
        $this->c_contrato_data_do_envio = $data["c_contrato_data_do_envio"];
        $this->c_contrato_data_da_assinatura = $data["c_contrato_data_da_assinatura"];
        $this->e_diretor_nome = $data["e_diretor_nome"];
        $this->e_diretor_email = $data["e_diretor_email"];
        $this->e_lider_nome = $data["e_lider_nome"];
        $this->e_lider_email = $data["e_lider_email"];
        $this->e_gerente_nome = $data["e_gerente_nome"];
        $this->e_gerente_email = $data["e_gerente_email"];
        $this->e_supervisor_nome = $data["e_supervisor_nome"];
        $this->e_supervisor_email = $data["e_supervisor_email"];
    }

    public function get_candidate_meta_fields(){
        return [
            "c_status" => $this->c_status,
            "c_vaga" => $this->c_vaga,
            "c_recrutador" => $this->c_recrutador,
            "c_recrutador_nome" => $this->c_recrutador_nome,
            "c_recrutador_telefone" => $this->c_recrutador_telefone,
            "c_linkedin" => $this->c_linkedin,
            "c_fonte" => $this->c_fonte,
            "c_email" => $this->c_email,
            "c_telefone" => $this->c_telefone,
            "c_tipo_de_documento" => $this->c_tipo_de_documento,
            "c_cpf" => $this->c_cpf,
            "c_cnpj" => $this->c_cnpj,
            "c_razao" => $this->c_razao,
            "c_cep" => $this->c_cep,
            "c_logradouro" => $this->c_logradouro,
            "c_numero" => $this->c_numero,
            "c_complemento" => $this->c_complemento,
            "c_bairro" => $this->c_bairro,
            "c_cidade" => $this->c_cidade,
            "c_estado" => $this->c_estado,
            "c_disponibilidade_tempo" => $this->c_disponibilidade_tempo,
            "c_disponibilidade_inicio" => $this->c_disponibilidade_inicio,
            "c_comissionamento" => $this->c_comissionamento,
            "c_ensino_medio" => $this->c_ensino_medio,
            "c_atendimento_ao_cliente" => $this->c_atendimento_ao_cliente,
            "c_possui_cnpj" => $this->c_possui_cnpj,
            "c_cnh" => $this->c_cnh,
            "c_ja_se_candidatou" => $this->c_ja_se_candidatou,
            "c_curso_superior" => $this->c_curso_superior,
            "c_mba" => $this->c_mba,
            "c_varejo" => $this->c_varejo,
            "c_vendas" => $this->c_vendas,
            "c_gerenciamento" => $this->c_gerenciamento,
            "c_dez_colaboradores" => $this->c_dez_colaboradores,
            "c_office" => $this->c_office,
            "c_seguir_processos" => $this->c_seguir_processos,
            "c_ajudar_pessoas" => $this->c_ajudar_pessoas,
            "c_proposito" => $this->c_proposito,
            "c_organizado" => $this->c_organizado,
            "c_multiplos_clientes" => $this->c_multiplos_clientes,
            "c_metrificar" => $this->c_metrificar,
            "c_selecao" => $this->c_selecao,
            "c_treinamento" => $this->c_treinamento,
            "c_decisoes" => $this->c_decisoes,
            "c_resolver" => $this->c_resolver,
            "c_experiencia_gestao" => $this->c_experiencia_gestao,
            "c_comunicacao" => $this->c_comunicacao,
            "c_comunicacao_grupo" => $this->c_comunicacao_grupo,
            "c_metas" => $this->c_metas,
            "c_emocional" => $this->c_emocional,
            "c_lideranca" => $this->c_lideranca,
            "c_proatividade" => $this->c_proatividade,
            "c_feedback" => $this->c_feedback,
            "c_avaliar" => $this->c_avaliar,
            "c_criatividade" => $this->c_criatividade,
            "c_resiliencia" => $this->c_resiliencia,
            "c_comercial" => $this->c_comercial,
            "c_aprender" => $this->c_aprender,
            "c_colaborar" => $this->c_colaborar,
            "c_persistencia" => $this->c_persistencia,
            "c_vendedor" => $this->c_vendedor,
            "c_proprio_negocio" => $this->c_proprio_negocio,
            "c_media" => $this->c_media,
            "c_objetivo_de_ganhos" => $this->c_objetivo_de_ganhos,
            "c_sobre_voce" => $this->c_sobre_voce,
            "c_signer_key" => $this->c_signer_key,
            "c_contratos_enviados" => $this->c_contratos_enviados,
            "c_contrato_tipo" => $this->c_contrato_tipo,
            "c_contrato_document_key" => $this->c_contrato_document_key,
            "c_contrato_sign_key" => $this->c_contrato_sign_key,
            "c_contrato_status" => $this->c_contrato_status,
            "c_contrato_data_do_envio" => $this->c_contrato_data_do_envio,
            "c_contrato_data_da_assinatura" => $this->c_contrato_data_da_assinatura,
            "e_diretor_nome" => $this->e_diretor_nome,
            "e_diretor_email" => $this->e_diretor_email,
            "e_lider_nome" => $this->e_lider_nome,
            "e_lider_email" => $this->e_lider_email,
            "e_gerente_nome" => $this->e_gerente_nome,
            "e_gerente_email" => $this->e_gerente_email,
            "e_supervisor_nome" => $this->e_supervisor_nome,
            "e_supervisor_email" => $this->e_supervisor_email
        ];
    }
}