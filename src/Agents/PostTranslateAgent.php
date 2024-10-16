<?php

namespace Brucelwayne\AI\Agents;

use Adrenallen\AiAgentsLaravel\Agents\BaseAgent;
use Brucelwayne\AI\LLMs\ChatGPT;

/**
 * Class representing an agent that translates and localizes post content.
 */
class PostTranslateAgent extends BaseAgent
{
    /**
     * Preface prompt for localization instructions.
     *
     * @var string
     */
    public string $prePrompt = "作为Mallria的内容本地化助手，你的任务是接收帖子内容并以我指定的地道的当地语言风格重写，超越直接翻译的范畴。
    1、删除文本中的价格信息和无意义的编号。
    2、去掉所有疑似价格的数字，但保留其他数字。
    3、生成至少3个tag，使用格式：空格+#+tag。每个tag不能超过32位，不能包含任何符号，#和tag之间无空格。
    4、tags必须使用当地语言来写。
    5、在优化后的内容后面添加tags。
    6、不要添加任何解释或说明，只提供优化后的内容和tags。
    7、确保整个内容完全使用当地语言，不允许出现任何其他语言的夹杂。
    
    优化完成后，按照以下格式输出：
    1. 用 `@@OPTIMIZED_TEXT_START@@` 标记优化后的内容开始，用 `@@OPTIMIZED_TEXT_END@@` 标记结束。
    2. 在文本结尾，用 `@@TAGS_START@@` 和 `@@TAGS_END@@` 标记生成的三个消费者吸引力标签，每个标签格式为：空格+#+tag。标签和 # 之间不要有空格，且标签限制为32个字符，不能包含任何符号。
    3. 你最终返回的必须是纯文本。
    
    优化后的内容请按照以下格式输出：
    @@OPTIMIZED_TEXT_START@@
    这里是优化后的文本
    @@OPTIMIZED_TEXT_END@@
    @@TAGS_START@@
    #tag1 #tag2 #tag3
    @@TAGS_END@@
    ";

    /**
     * Constructor to initialize the ChatGPT model.
     *
     * @param ChatGPT $chatModel The language model instance used for translations.
     */
    public function __construct(ChatGPT $chatModel)
    {
        parent::__construct($chatModel);
    }

    /**
     * Translates and adapts the given content into the specified local language.
     *
     * @param string $language Target language code.
     * @param string $content The original content to be localized.
     *
     * @return mixed The AI response containing the localized content or error message in JSON format.
     */
    public function translateForLocale(string $language, string $content)
    {
        // Construct the full prompt combining the pre-prompt with the specific language instruction and content.
        $fullPrompt = "请采用{$language}的语言特色来表达，tag也用{$language}来写，请确保确保整个内容完全使用{$language}语言，不允许出现任何其他语言的夹杂：\n" . $content;

        // Delegate to the AI model for processing the localization request.
        return $this->ask($fullPrompt);
    }
}