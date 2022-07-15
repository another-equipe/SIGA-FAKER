
<?php

include_once __DIR__."/class.candidate.php";
include_once __DIR__."/class.mocker.php";

define("CANDIDATES_POST_TYPE_SLUG", "c_consultores");
define("DEFAULT_USER_PASS", "Savecash@2022");
define("CANDIDATE_HIERARQUIES", [
    "diretor" => 0,
    "lider" => 1,
    "gerente" => 2,
    "supervisor" => 3,
    "consultor" => 4
]);

class SIGAFaker{

    public function activate(){
        $environment = strpos($_SERVER['HTTP_HOST'], 'dev') ? "DEV" : "PRODUCTION";
        
        if ($environment == "PRODUCTION"){
            echo "Plugin pode ser ativado apenas em ambiente de teste";
            return;   
        }

        $mocker = new Mocker("e53c1200", "2496b170");
        $mock = $mocker->get_mock(1000);

        if (sizeof($mock) == 0) {
            $string = file_get_contents(__DIR__."/../default_fake_data.json");
            $mock = json_decode($string, true);
        }
        
        $mock = $this->balance_candidates($mock);
        $this->set_candidates_superiors_and_recruiters($mock);
        
        $this->delete_candidates_and_users();

        foreach ($mock as $fake_candidate) {
            $candidate = new Candidate($fake_candidate);

            $this->create_candidate($candidate);

            if ($candidate->c_status == "contratado"){
                $this->create_user($candidate);
            }
        }

        flush_rewrite_rules();
    }

    public function deactivate(){
        flush_rewrite_rules();
    }

    private function delete_candidates_and_users(){
        global $wpdb;

        $sql_delete_subscriber_users = "
        DELETE FROM
            wp_users
        WHERE 
            ID IN
            (
                SELECT
                    user_id
                FROM
                    wp_usermeta
                WHERE
                    meta_key = 'wp_capabilities'
                    AND meta_value LIKE '%subscriber%'
            )
        ";

       $sql_delete_postmetas ="
        DELETE
            FROM
                `wp_postmeta` 
            WHERE
            post_id IN 
            (
                SELECT
                    ID 
                FROM
                    wp_posts 
                WHERE
                    post_type = '%s'
            )
        ";

        $sql_delete_posts = "
        DELETE FROM
            `wp_posts` 
        WHERE
            post_type = '%s'
        ";
        

        $subscriber_users_delete_result = $wpdb->get_results($sql_delete_subscriber_users);
        $post_metas_delete_result = $wpdb->get_results($wpdb->prepare($sql_delete_postmetas, CANDIDATES_POST_TYPE_SLUG));
        $posts_delete_result = $wpdb->get_results($wpdb->prepare($sql_delete_posts, CANDIDATES_POST_TYPE_SLUG));

        return boolval($subscriber_users_delete_result)
            && boolval($post_metas_delete_result)
            && boolval($posts_delete_result)
        ;
    }

    private function create_candidate(Candidate $candidate){
        $this->create_post(CANDIDATES_POST_TYPE_SLUG, [
            "post_title" => $candidate->nome,
            "is_fake" => true,
            "meta" => $candidate->get_candidate_meta_fields()
        ]);
    }

    private function create_user(Candidate $candidate){
        $user_data = [
            "user_pass" => DEFAULT_USER_PASS,
            "user_login" => $candidate->c_email,
            "user_nicename" => sanitize_title($candidate->nome),
            "nickname" => $candidate->nome,
            "first_name" => $candidate->nome,
            "user_email" => $candidate->c_email,
            "display_name" => $candidate->nome,
            "description" => $candidate->c_sobre_voce,
            "show_admin_bar_front" => "false",
            "role" => "subscriber",
            "meta_input" => [
                "u_funcao" => $candidate->c_vaga,
                "u_id_no_bitrix" => rand(1, 1000000),
                "u_id_do_departamento" => rand(1, 1000000),
                "u_aceitou_o_convite" => rand(0, 1) == 1 ? "sim" : "não",
                "u_bitrix_sync" => round(microtime(true) * 1000),
                "u_funil_onboarding" => rand(0, 1) == 1 ? "ok" : "",
                "u_tipo" => $candidate->c_tipo_de_documento,
                "u_cpf" => $candidate->c_cpf,
                "u_cnpj" => $candidate->c_cnpj,
                "u_razao" => $candidate->c_razao,
                "u_cidade" => $candidate->c_cidade,
                "u_estado" => $candidate->c_estado,
                "u_bairro" => $candidate->c_bairro,
                "u_rua" => $candidate->c_logradouro,
                "u_numero" => $candidate->c_numero
            ]
        ];

        return wp_insert_user($user_data);
    }

    private function get_imediate_superior($candidate, $candidate_arr, $choose_random = false){
        if (CANDIDATE_HIERARQUIES[$candidate["c_vaga"]] == CANDIDATE_HIERARQUIES["diretor"]) return null;
        
        if ($choose_random){
            $imediate_superior_hierarquie = array_flip(CANDIDATE_HIERARQUIES)[CANDIDATE_HIERARQUIES[$candidate["c_vaga"]] - 1];
            $start = array_search(
                $imediate_superior_hierarquie,
                array_column($candidate_arr, "c_vaga")
            );
            $end = $start;
            
            for ($i = sizeof($candidate_arr) - 1; $i >= 0; $i--){
                if ($candidate_arr[$i]["c_vaga"] == $imediate_superior_hierarquie){
                    $end = $i;
                    break;
                }
            }
    
            return $candidate_arr[rand($start, $end)];
        }
    
        return $candidate_arr[
            array_search(
                $candidate["c_recrutador"],
                array_column($candidate_arr, "c_email")
            )
        ];
    }
    
    private function get_superiors_recursive($candidate, $candidate_arr){
        $superiors = [
            "imediate_superior" => null,
            "diretor" => null,
            "lider" => null,
            "gerente" => null,
            "supervisor" => null
        ];
    
        if (CANDIDATE_HIERARQUIES[$candidate["c_vaga"]] == CANDIDATE_HIERARQUIES["diretor"]) return $superiors;
    
        $superiors_cascade = [$candidate];
        $superiors["imediate_superior"] = array_flip(CANDIDATE_HIERARQUIES)[CANDIDATE_HIERARQUIES[$candidate["c_vaga"]] - 1];
        
        while(end($superiors_cascade)["c_vaga"] != "diretor"){
            $last_item = end($superiors_cascade);
    
            if (is_null($last_item)) break;
    
            $superior = $this->get_imediate_superior($last_item, $candidate_arr, sizeof($superiors_cascade) == 1);
            $superiors_cascade = [...$superiors_cascade, $superior];
            $superiors[array_flip(CANDIDATE_HIERARQUIES)[CANDIDATE_HIERARQUIES[$last_item["c_vaga"]] - 1]] = $superior;
        }
    
        return $superiors;
    }
    
    private function set_candidates_superiors_and_recruiters(&$candidate_arr){
        usort($candidate_arr, function($candidate1, $candidate2) {
            $candidate1_hierarquie = CANDIDATE_HIERARQUIES[$candidate1["c_vaga"]];
            $candidate2_hierarquie = CANDIDATE_HIERARQUIES[$candidate2["c_vaga"]];
            
            if ($candidate1_hierarquie == $candidate2_hierarquie) return 0;
            
            return ($candidate1_hierarquie < $candidate2_hierarquie) ? -1 : 1;
        });
        
        foreach ($candidate_arr as &$candidate) {
            $superiors = $this->get_superiors_recursive($candidate, $candidate_arr);
    
            $candidate["c_recrutador"] = $superiors[
                $superiors["imediate_superior"]
            ]["c_email"] ?? "f@savecash.com.br";
    
            $candidate["c_recrutador_nome"] = $superiors[
                $superiors["imediate_superior"]
            ]["nome"] ?? "Fabian Ariel";
    
            $candidate["c_recrutador_telefone"] = $superiors[
                $superiors["imediate_superior"]
            ]["c_telefone"] ?? "+5541995230276";
    
            $candidate["e_diretor_nome"] = $superiors["diretor"]["nome"];
            $candidate["e_diretor_email"] = $superiors["diretor"]["c_email"];
            $candidate["e_lider_nome"] = $superiors["lider"]["nome"];
            $candidate["e_lider_email"] = $superiors["lider"]["c_email"];
            $candidate["e_gerente_nome"] = $superiors["gerente"]["nome"];
            $candidate["e_gerente_email"] = $superiors["gerente"]["c_email"];
            $candidate["e_supervisor_nome"] = $superiors["supervisor"]["nome"];
            $candidate["e_supervisor_email"] = $superiors["supervisor"]["c_email"];
        }
    }

    private function balance_candidates($candidates_arr){
        $hired_directors = array_slice(array_filter($candidates_arr, function($candidate){
            return ($candidate["c_vaga"] == "diretor" && $candidate["c_status"] == "contratado");
        }), 0, 4);
        
        $hired_liders = array_slice(array_filter($candidates_arr, function($candidate){
            return ($candidate["c_vaga"] == "lider" && $candidate["c_status"] == "contratado");
        }), 0, sizeof($hired_directors) * 3);
    
        $hired_managers = array_slice(array_filter($candidates_arr, function($candidate){
            return ($candidate["c_vaga"] == "gerente" && $candidate["c_status"] == "contratado");
        }), 0, sizeof($hired_liders) * 3);
    
        $hired_supervisors = array_slice(array_filter($candidates_arr, function($candidate){
            return ($candidate["c_vaga"] == "supervisor" && $candidate["c_status"] == "contratado");
        }), 0, sizeof($hired_managers) * 3);
    
        $hired_consultors = array_slice(array_filter($candidates_arr, function($candidate){
            return ($candidate["c_vaga"] == "consultor" && $candidate["c_status"] == "contratado");
        }), 0, sizeof($hired_supervisors) * 3);
    
        $unhired_candidates = array_filter($candidates_arr, function($candidate){
            return ($candidate["c_status"] != "contratado");
        });
    
        return [
            ...$unhired_candidates, 
            ...$hired_directors,
            ...$hired_liders,
            ...$hired_managers,
            ...$hired_supervisors,
            ...$hired_consultors
        ];
    }

    private function create_post($post_type_slug, $post_data){
        $meta_fields = [];

        foreach ($post_data["meta"] as $key => $value) {
            $meta_fields[$key] = $value;
        }

        $meta_fields["is_fake"] = true;

        $post = [
            "post_title" =>  $post_data["post_title"] ?? "",
            "post_content" => $post_data["post_content"] ?? "",
            "post_status" =>  $post_data["post_status"] ?? "publish",
            "post_type" => $post_type_slug,
            "meta_input" => $meta_fields
        ];

        wp_insert_post($post);
    }
}