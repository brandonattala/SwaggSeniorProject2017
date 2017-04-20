using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Data.Entity.Infrastructure;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;
using System.Web.Http.Description;
using Swagg.Api.Models;
using Facebook;
using Swagg.Api.Integrations;

namespace Swagg.Api.Controllers
{
    public class PromotionsController : ApiController
    {
        private const string FbTestToken = @"EAAPlpXZA91DgBALMLj3NU4X7VvwCwc3uXDYeEjvxtwX8QXCty0fz35enEtppZBrR6lJLS8F5JYxjYFbmVyf91H84fcnOH5iUy4v7IMTrCFmNWm7pydGFKNsPco80pSbyZB0G9aCrrs11XUOtQGjOu686T3ZCjtz84Je2sNiFZAwZDZD";

        private SwaggDbContext db = new SwaggDbContext();

        public IQueryable<Promotion> GetPromotions(int? userId = null, bool? current = null, PromotionCategory? category = null)
        {
            IQueryable<Promotion> query = db.Promotions;
            if (userId != null)
                query = query.Where(z => z.UserId == userId);
            if (current != null)
                query = query.Where(z => z.Start <= DateTime.Now && z.End >= DateTime.Now);
            if (category != null)
                query = query.Where(z => z.Category == category);

            return query.Include(z => z.Files);
        }

        // GET: api/Promotions/5
        [ResponseType(typeof(Promotion))]
        public IHttpActionResult GetPromotion(int id)
        {
            Promotion promotion = db.Promotions.Include(z => z.Files).FirstOrDefault(z => z.PromotionId == id);
            if (promotion == null)
            {
                return NotFound();
            }

            return Ok(promotion);
        }

        // PUT: api/Promotions/5
        [ResponseType(typeof(void))]
        public IHttpActionResult PutPromotion(int id, Promotion promotion)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != promotion.PromotionId)
            {
                return BadRequest();
            }

            foreach(var file in promotion.Files)
            {
                file.PromotionId = id;
                db.Entry(file).State = EntityState.Modified;
            }
            db.Entry(promotion).State = EntityState.Modified;

            try
            {
                db.SaveChanges();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!PromotionExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return StatusCode(HttpStatusCode.NoContent);
        }

        // POST: api/Promotions
        [ResponseType(typeof(Promotion))]
        public IHttpActionResult PostPromotion(Promotion promotion)
        {
            if (!ModelState.IsValid)
                return BadRequest(ModelState);

            db.Promotions.Add(promotion);
            db.SaveChanges();

            if (promotion.FacebookPost)
                FacebookUtil.PostPromotion(FbTestToken, promotion);

            return CreatedAtRoute("DefaultApi", new { id = promotion.PromotionId }, promotion);
        }

        // DELETE: api/Promotions/5
        [ResponseType(typeof(Promotion))]
        public IHttpActionResult DeletePromotion(int id)
        {
            Promotion promotion = db.Promotions.Find(id);
            if (promotion == null)
            {
                return NotFound();
            }

            db.Promotions.Remove(promotion);
            db.SaveChanges();

            return Ok(promotion);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }

        private bool PromotionExists(int id)
        {
            return db.Promotions.Count(e => e.PromotionId == id) > 0;
        }
    }
}