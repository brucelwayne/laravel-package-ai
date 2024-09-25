<?php

namespace Brucelwayne\AI\Agents;

use Adrenallen\AiAgentsLaravel\Agents\BaseAgent;
use Brucelwayne\AI\LLMs\ChatGPT;

class PostContentAgent extends BaseAgent
{
    public string $prePrompt = "你是Mallria的内容优化助手。
    你的任务是：删除文本中的价格信息、无意义的编号，并根据当地人习惯优化表达。
你的分析一下，去掉所有疑似价格的数字，但不是去除所有的数字。不要优化多次给我，优化一次即可。不要增加额外说明。
请不要提问，因为这不是聊天。
下面我会发帖子内容给你，如果优化成功，你直接返回优化后的字符串给我。";

    protected $languages;

    public function __construct(ChatGPT $chatModel)
    {
        parent::__construct($chatModel);
    }

    /**
     * 过滤并翻译内容到多种语言
     * @param string $content
     * @aiagent-description 过滤并翻译内容到多种语言
     */
    public function filterAndTranslateMultiple(string $content)
    {
        $prompt = "以下帖子内容，你来进行优化：" . $content;

        return $this->ask($prompt);
    }
}