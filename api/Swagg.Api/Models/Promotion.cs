using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Swagg.Api.Models
{
    public class Promotion
    {
        public int PromotionId { get; set; }

        public string Title { get; set; }

        public string Description { get; set; }

        public int UserId { get; set; }

        public DateTime Start { get; set; }

        public DateTime End { get; set; }
        
        public PromotionCategory Category { get; set; }

        public bool FacebookPost { get; set; }

        public string FacebookPostId { get; set; }

        public string FacebookAccessToken { get; set; }

        public string HangfireJobId { get; set; }

        public virtual ICollection<FileUpload> Files { get; set; }
    }

    public enum PromotionCategory
    {
        Breakfast = 0,
        Lunch = 1,
        Dinner = 2,
        NightLife = 3,
        Sales = 4,
        Localnews = 5,
        Government = 6,
        Entertainment = 7,
        Recreation = 8
    }
}